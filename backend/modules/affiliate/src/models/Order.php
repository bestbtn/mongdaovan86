<?php

namespace modava\affiliate\models;

use common\models\User;
use modava\affiliate\AffiliateModule;
use modava\affiliate\models\table\OrderTable;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use common\helpers\MyHelper;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "affiliate_order".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $coupon_id Mã coupon
 * @property string $pre_total Số tiền trên đơn hàng
 * @property string $discount Số tiền được chiết khấu
 * @property string $final_total Số tiền còn lại
 * @property string $description Mô tả
 * @property int $date_create Ngày tạo
 * @property int $status Tình trạng đơn hàng
 * @property int $payment_method Phương thức thanh toán
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property Coupon $coupon
 * @property User $createdBy
 * @property User $updatedBy
 */
class Order extends OrderTable
{
    public $toastr_key = 'affiliate-order';

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'slug' => [
                    'class' => SluggableBehavior::class,
                    'immutable' => false,
                    'ensureUnique' => true,
                    'value' => function () {
                        return MyHelper::createAlias($this->title);
                    }
                ],
                [
                    'class' => BlameableBehavior::class,
                    'createdByAttribute' => 'created_by',
                    'updatedByAttribute' => 'updated_by',
                ],
                'timestamp' => [
                    'class' => 'yii\behaviors\TimestampBehavior',
                    'preserveNonEmptyValues' => false,
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                        ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                    ],
                ],
                [
                    'class' => AttributeBehavior::class,
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['discount'],
                        ActiveRecord::EVENT_BEFORE_UPDATE => ['discount'],
                    ],
                    'value' => function ($event) {
                        $coupon = $this->coupon;
                        $promotion_type = $coupon->promotion_type;

                        if ($promotion_type === Coupon::DISCOUNT_PERCENT) {
                            $discountValue = ($coupon->promotion_value / 100) * $this->pre_total;
                        } else {
                            $discountValue = $coupon->promotion_value;
                        }

                        return $discountValue;
                    },
                ],
                [
                    'class' => AttributeBehavior::class,
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['final_total'],
                        ActiveRecord::EVENT_BEFORE_UPDATE => ['final_total'],
                    ],
                    'value' => function ($event) {
                        $this->final_total = (float) $this->pre_total - (float) $this->discount;

                        return $this->final_total > 0 ? $this->final_total : 0;
                    },
                ],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'coupon_id', 'pre_total', 'date_create', 'status', 'payment_method',], 'required'],
            [['coupon_id', 'status',], 'integer'],
            [['pre_total', 'discount', 'final_total'], 'number'],
            [['description', 'payment_method'], 'string'],
            [['date_create',], 'safe'],
            [['title', 'slug', 'partner_order_code'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['coupon_id'], 'exist', 'skipOnError' => true, 'targetClass' => Coupon::class, 'targetAttribute' => ['coupon_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => AffiliateModule::t('affiliate', 'ID'),
            'title' => AffiliateModule::t('affiliate', 'Title'),
            'slug' => AffiliateModule::t('affiliate', 'Slug'),
            'coupon_id' => AffiliateModule::t('affiliate', 'Coupon ID'),
            'pre_total' => AffiliateModule::t('affiliate', 'Pre Total'),
            'discount' => AffiliateModule::t('affiliate', 'Discount'),
            'final_total' => AffiliateModule::t('affiliate', 'Final Total'),
            'description' => AffiliateModule::t('affiliate', 'Description'),
            'created_at' => AffiliateModule::t('affiliate', 'Created At'),
            'updated_at' => AffiliateModule::t('affiliate', 'Updated At'),
            'created_by' => AffiliateModule::t('affiliate', 'Created By'),
            'updated_by' => AffiliateModule::t('affiliate', 'Updated By'),
            'date_create' => AffiliateModule::t('affiliate', 'Ngày tạo'),
            'status' => AffiliateModule::t('affiliate', 'Tình trạng'),
            'payment_method' => AffiliateModule::t('affiliate', 'Phương thức thanh toán'),
            'partner_order_code' => AffiliateModule::t('affiliate', 'Mã đơn hàng hệ thống partner'),
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserCreated()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserUpdated()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    public function getCoupon()
    {
        return $this->hasOne(Coupon::class, ['id' => 'coupon_id']);
    }

    public function loadFromApi($params) {
        $formName = $this->formName();
        $paramsPrepare = [];

        if (array_key_exists('coupon_code', $params)) {
            $coupon = Coupon::checkCoupon($params['coupon_code']);

            if ($coupon) {
                $params['coupon_id'] = $coupon->primaryKey;
            }
        }

        foreach ($params as $k => $v) {
            $paramsPrepare[$formName][$k] = $v;
        }

        return $this->load($paramsPrepare);
    }
}

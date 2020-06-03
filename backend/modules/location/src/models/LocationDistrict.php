<?php

namespace modava\location\models;

use common\models\User;
use modava\location\LocationModule;
use modava\location\models\table\LocationDistrictTable;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "location_district".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $Type
 * @property string $LatiLongTude
 * @property int $ProvinceId
 * @property int $SortOrder
 * @property int $status
 * @property string $language Language
 * @property int $IsDeleted
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property User $createdBy
 * @property LocationProvince $province
 * @property User $updatedBy
 * @property LocationWard[] $locationWards
 */
class LocationDistrict extends LocationDistrictTable
{
    public $toastr_key = 'location-district';
    public $countryId;

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                [
                    'class' => BlameableBehavior::class,
                    'createdByAttribute' => 'created_by',
                    'updatedByAttribute' => 'updated_by',
                ],
                'timestamp' => [
                    'class' => 'yii\behaviors\TimestampBehavior',
                    'preserveNonEmptyValues' => true,
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                        ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                    ],
                ],
            ]
        );
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'language', 'ProvinceId'], 'required'],
            [['countryId'], 'required', 'message' => 'Quốc gia không được để trống'],
            [['ProvinceId', 'SortOrder', 'status', 'IsDeleted', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['language'], 'string'],
            [['name', 'slug', 'Type', 'LatiLongTude'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['ProvinceId'], 'exist', 'skipOnError' => true, 'targetClass' => LocationProvince::class, 'targetAttribute' => ['ProvinceId' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => LocationModule::t('location', 'ID'),
            'name' => LocationModule::t('location', 'Name'),
            'slug' => LocationModule::t('location', 'Slug'),
            'Type' => LocationModule::t('location', 'Type'),
            'LatiLongTude' => LocationModule::t('location', 'Lati Long Tude'),
            'ProvinceId' => LocationModule::t('location', 'Province ID'),
            'SortOrder' => LocationModule::t('location', 'Sort Order'),
            'status' => LocationModule::t('location', 'Status'),
            'language' => LocationModule::t('location', 'Language'),
            'IsDeleted' => LocationModule::t('location', 'Is Deleted'),
            'created_at' => LocationModule::t('location', 'Created At'),
            'updated_at' => LocationModule::t('location', 'Updated At'),
            'created_by' => LocationModule::t('location', 'Created By'),
            'updated_by' => LocationModule::t('location', 'Updated By'),
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
}

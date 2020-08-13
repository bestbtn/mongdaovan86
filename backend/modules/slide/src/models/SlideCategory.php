<?php

namespace modava\slide\models;

use common\models\User;
use modava\slide\SlideModule;
use modava\slide\models\table\SlideCategoryTable;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use common\helpers\MyHelper;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "slide_category".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $image
 * @property string $description
 * @property int $position
 * @property int $status
 * @property string $language
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class SlideCategory extends SlideCategoryTable
{
    public $toastr_key = 'slide-category';

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
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'slug'], 'required'],
            [['description'], 'string'],
            [['position', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['title', 'slug', 'image'], 'string', 'max' => 255],
            [['language'], 'string', 'max' => 25],
            [['slug'], 'unique'],
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
            'id' => SlideModule::t('slide', 'ID'),
            'title' => SlideModule::t('slide', 'Title'),
            'slug' => SlideModule::t('slide', 'Slug'),
            'image' => SlideModule::t('slide', 'Image'),
            'description' => SlideModule::t('slide', 'Description'),
            'position' => SlideModule::t('slide', 'Position'),
            'status' => SlideModule::t('slide', 'Status'),
            'language' => SlideModule::t('slide', 'Language'),
            'created_at' => SlideModule::t('slide', 'Created At'),
            'updated_at' => SlideModule::t('slide', 'Updated At'),
            'created_by' => SlideModule::t('slide', 'Created By'),
            'updated_by' => SlideModule::t('slide', 'Updated By'),
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->on(yii\db\BaseActiveRecord::EVENT_AFTER_INSERT, function (yii\db\AfterSaveEvent $e) {
            if ($this->position == null)
                $this->position = $this->primaryKey;
            $this->save();
        });
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
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

<?php

namespace modava\article\models;

use common\helpers\MyHelper;
use common\models\User;
use modava\article\models\table\ArticleTable;
use Yii;
use modava\article\ArticleModule;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property int $category_id
 * @property int $type_id
 * @property string $title
 * @property string $slug
 * @property string|null $image
 * @property string|null $description
 * @property string|null $content
 * @property int|null $position
 * @property string|null $ads_pixel
 * @property string|null $ads_session
 * @property int $status
 * @property int|null $views
 * @property string $language Language for yii2
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property ArticleType $type
 * @property ArticleCategory $category
 */
class Article extends ArticleTable
{
    public $toastr_key = 'article';
<<<<<<< HEAD
=======

>>>>>>> master
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
                    'preserveNonEmptyValues' => true,
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                        ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                    ],
                ],
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'language', 'content'], 'required'],
            [['category_id'], 'required', 'message' => ArticleModule::t('article', 'Danh mục không được để trống')],
            [['type_id'], 'required', 'message' => ArticleModule::t('article', 'Thể loại không được để trống')],
            [['category_id', 'type_id', 'position', 'status', 'views', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['content', 'ads_pixel', 'ads_session', 'description', 'language'], 'string'],
<<<<<<< HEAD
            ['language','in','range'=>['vi','en','jp'],'strict'=>false],
            [['title', 'slug', 'image'], 'string', 'max' => 255],
            ['image', 'file', 'extensions' => ['png', 'jpg', 'gif'],
                'maxSize' => 1024*1024],
=======
            ['language', 'in', 'range' => ['vi', 'en', 'jp'], 'strict' => false],
            [['title', 'slug', 'image'], 'string', 'max' => 255],
            ['image', 'file', 'extensions' => ['png', 'jpg', 'gif'],
                'maxSize' => 1024 * 1024],
>>>>>>> master
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ArticleType::class, 'targetAttribute' => ['type_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ArticleCategory::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => ArticleModule::t('article', 'ID'),
            'category_id' => ArticleModule::t('article', 'Category ID'),
            'type_id' => ArticleModule::t('article', 'Type ID'),
            'title' => ArticleModule::t('article', 'Title'),
            'slug' => ArticleModule::t('article', 'Slug'),
            'image' => ArticleModule::t('article', 'Image'),
            'description' => ArticleModule::t('article', 'Description'),
            'content' => ArticleModule::t('article', 'Content'),
            'position' => ArticleModule::t('article', 'Position'),
            'ads_pixel' => ArticleModule::t('article', 'Ads Pixel'),
            'ads_session' => ArticleModule::t('article', 'Ads Session'),
            'status' => ArticleModule::t('article', 'Status'),
            'views' => ArticleModule::t('article', 'Views'),
            'language' => ArticleModule::t('article', 'Language'),
            'created_at' => ArticleModule::t('article', 'Created At'),
            'updated_at' => ArticleModule::t('article', 'Updated At'),
            'created_by' => ArticleModule::t('article', 'Created By'),
            'updated_by' => ArticleModule::t('article', 'Updated By'),
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->on(yii\db\BaseActiveRecord::EVENT_AFTER_INSERT, function (yii\db\AfterSaveEvent $e) {
<<<<<<< HEAD
            $this->position = $this->primaryKey;
=======
            if ($this->position == null)
                $this->position = $this->primaryKey;
>>>>>>> master
            $this->save();
        });
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }


    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ArticleType::class, ['id' => 'type_id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ArticleCategory::class, ['id' => 'category_id']);
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

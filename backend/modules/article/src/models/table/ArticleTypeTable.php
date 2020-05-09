<?php

namespace modava\article\models\table;

use cheatsheet\Time;
use modava\article\models\query\ArticleTypeQuery;
use Yii;


class ArticleTypeTable extends \yii\db\ActiveRecord
{
    const STATUS_PUBLISHED = 1;
    const STATUS_DISABLED = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article_type';
    }

    public static function find()
    {
        return new ArticleTypeQuery(get_called_class());
    }

    public static function getAllArticleType()
    {
        $cache = Yii::$app->cache;
        $key = 'redis-get-all-article-type';

        $data = $cache->get($key);

        if ($data === false) {
            $data = self::find()->published()->sortDescById()->all();
            $cache->set($key, $data, Time::SECONDS_IN_A_MONTH);
        }

        return $data;
    }

    public function afterDelete()
    {
        $cache = Yii::$app->cache;
        $key = 'redis-get-all-article-type';
        $cache->delete($key);
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }

    public function afterSave($insert, $changedAttributes)
    {
        $cache = Yii::$app->cache;
        $key = 'redis-get-all-article-type';
        $cache->delete($key);
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }
}
<?php

namespace modava\slide\models\table;

use cheatsheet\Time;
use modava\slide\models\query\SlideTypeQuery;
use Yii;
use yii\db\ActiveRecord;

class SlideTypeTable extends \yii\db\ActiveRecord
{
    const STATUS_DISABLED = 0;
    const STATUS_PUBLISHED = 1;

    public static function tableName()
    {
        return 'slide_type';
    }

    public static function find()
    {
        return new SlideTypeQuery(get_called_class());
    }

    public static function getAllSlideType($lang = null)
    {
        $cache = Yii::$app->cache;
        $key = 'redis-get-all-slide-type-' . $lang;

        $data = $cache->get($key);

        if ($data === false) {
            $query = self::find();
            if ($lang != null)
                $query->where(['language' => $lang]);
            $data = $query->published()->sortDescById()->all();
            $cache->set($key, $data, Time::SECONDS_IN_A_MONTH);
        }

        return $data;
    }

    public function afterDelete()
    {
        $cache = Yii::$app->cache;
        $keys = [
            'redis-get-all-slide-type-' . $this->language,
        ];
        foreach ($keys as $key) {
            $cache->delete($key);
        }
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }

    public function afterSave($insert, $changedAttributes)
    {
        $cache = Yii::$app->cache;
        $keys = [
            'redis-get-all-slide-type-' . $this->language,
        ];
        foreach ($keys as $key) {
            $cache->delete($key);
        }
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }
}
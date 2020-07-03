<?php

namespace modava\location\models\table;

use cheatsheet\Time;
use modava\location\models\query\LocationDistrictQuery;
use Yii;
use yii\db\ActiveRecord;

class LocationDistrictTable extends \yii\db\ActiveRecord
{
    const STATUS_DISABLED = 0;
    const STATUS_PUBLISHED = 1;

    public static function tableName()
    {
        return 'location_district';
    }

    public static function find()
    {
        return new LocationDistrictQuery(get_called_class());
    }

    public function getProvinceHasOne()
    {
        return $this->hasOne(LocationProvinceTable::class, ['id' => 'ProvinceId']);
    }

    public function afterDelete()
    {
        $cache = Yii::$app->cache;
        $keys = [
            'redis-get-district-by-province-' . $this->ProvinceId . '-' . $this->language,
            'redis-location-district-get-district-by-id-' . $this->id . '-' . $this->language
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
            'redis-get-district-by-province-' . $this->ProvinceId . '-' . $this->language,
            'redis-location-district-get-district-by-id-' . $this->id . '-' . $this->language
        ];
        foreach ($keys as $key) {
            $cache->delete($key);
        }
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

    public static function getDistrictById($id, $language = null)
    {
        $cache = Yii::$app->cache;
        $key = 'redis-location-district-get-district-by-id-' . $id . '-' . $language;
        $data = $cache->get($key);
        if ($data == false) {
            $data = self::find()->where(['id' => $id, 'language' => $language ?: Yii::$app->language])->published()->one();
            $cache->set($key, $data);
        }
        return $data;
    }

    public static function getDistrictByProvince($province = null, $language = null)
    {
        $cache = Yii::$app->cache;
        $key = 'redis-get-district-by-province-' . $province . '-' . $language;
        $data = $cache->get($key);
        if ($data === false) {
            $query = self::find()->select(["*", "CONCAT(Type, ' ', name) AS name"])->where([self::tableName() . '.ProvinceId' => $province]);
            if ($language !== null) $query->andWhere([self::tableName() . '.language' => $language]);
            $data = $query->published()->sortAscBySortOrder()->all();
            $cache->set($key, $data, Time::SECONDS_IN_A_MONTH);
        }
        return $data;
    }
}

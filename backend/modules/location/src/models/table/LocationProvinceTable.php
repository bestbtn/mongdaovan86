<?php

namespace modava\location\models\table;

use cheatsheet\Time;
use modava\location\LocationModule;
use modava\location\models\query\LocationProvinceQuery;
use Yii;
use yii\db\ActiveRecord;

class LocationProvinceTable extends \yii\db\ActiveRecord
{
    const STATUS_DISABLED = 0;
    const STATUS_PUBLISHED = 1;

    public static function tableName()
    {
        return 'location_province';
    }

    public static function find()
    {
        return new LocationProvinceQuery(get_called_class());
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'name' => Yii::t('backend', 'Name'),
            'slug' => Yii::t('backend', 'Slug'),
            'Type' => Yii::t('backend', 'Type'),
            'TelephoneCode' => Yii::t('backend', 'Telephone Code'),
            'ZipCode' => Yii::t('backend', 'Zip Code'),
            'CountryId' => Yii::t('backend', 'Quốc gia'),
            'CountryCode' => Yii::t('backend', 'Country Code'),
            'SortOrder' => Yii::t('backend', 'Sort Order'),
            'status' => Yii::t('backend', 'Status'),
            'language' => Yii::t('backend', 'Language'),
            'IsDeleted' => Yii::t('backend', 'Is Deleted'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'created_by' => Yii::t('backend', 'Created By'),
            'updated_by' => Yii::t('backend', 'Updated By'),
        ];
    }

    public function getCountryHasOne()
    {
        return $this->hasOne(LocationCountryTable::class, ['id' => 'CountryId']);
    }

    public function afterDelete()
    {
        $cache = Yii::$app->cache;
        $keys = [
            'redis-get-province-by-country-' . $this->CountryId . '-' . $this->language,
            'redis-location-province-get-province-by-id-' . $this->id . '-' . $this->language
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
            'redis-get-province-by-country-' . $this->CountryId . '-' . $this->language,
            'redis-location-province-get-province-by-id-' . $this->id . '-' . $this->language
        ];
        foreach ($keys as $key) {
            $cache->delete($key);
        }
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

    public static function getProvincetById($id, $language = null)
    {
        $cache = Yii::$app->cache;
        $key = 'redis-location-province-get-province-by-id-' . $id . '-' . $language;
        $data = $cache->get($key);
        if ($data == false) {
            $data = self::find()->where(['id' => $id, 'language' => $language ?: Yii::$app->language])->published()->one();
            $cache->set($key, $data);
        }
        return $data;
    }

    public static function getProvinceByCountry($country = 237, $lang = 'vi')
    {
//        $cache = Yii::$app->cache;
//        $key = 'redis-get-province-by-country-' . $country . '-' . $lang;
//        $data = $cache->get($key);
//        if ($data === false) {
        $query = self::find()->select(["*", "CONCAT(Type, ' ', name) AS name"])->where([self::tableName() . '.CountryId' => $country]);
        if ($lang !== null) $query->andWhere([self::tableName() . '.language' => $lang]);
        $data = $query->sortAscBySortOrder()->all();
//            $cache->set($key, $data, Time::SECONDS_IN_A_MONTH);
//        }
        return $data;
    }
}

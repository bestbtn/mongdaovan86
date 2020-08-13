<?php

namespace modava\contact\models\table;

use cheatsheet\Time;
use modava\contact\models\query\ContactQuery;
use Yii;
use yii\db\ActiveRecord;

class ContactTable extends \yii\db\ActiveRecord
{
    const STATUS_DISABLED = 0;
    const STATUS_PUBLISHED = 1;

    public static function tableName()
    {
        return 'contact';
    }

    public static function find()
    {
        return new ContactQuery(get_called_class());
    }
<<<<<<< HEAD

    public function afterDelete()
    {
        $cache = Yii::$app->cache;
        $keys = [];
        foreach ($keys as $key) {
            $cache->delete($key);
        }
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }

    public function afterSave($insert, $changedAttributes)
    {
        $cache = Yii::$app->cache;
        $keys = [];
        foreach ($keys as $key) {
            $cache->delete($key);
        }
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }
=======
>>>>>>> master
}

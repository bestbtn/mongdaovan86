<?php

use yii\db\Migration;

/**
 * Class m200603_080913_create_table_social_fanpage
 */
class m200603_080913_create_table_social_fanpage extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }
        $check_social_fanpage = Yii::$app->db->getTableSchema('social_fanpage');
        if ($check_social_fanpage === null) {
            $this->createTable('social_fanpage', [
                'id' => $this->primaryKey(),
                'origin_id' => $this->integer(11)->notNull(),
                'name' => $this->string(255)->notNull(),
                'slug' => $this->string(255)->null(),
                'description' => $this->text()->null(),
                'url_page' => $this->string(255)->null(),
                'status' => $this->tinyInteger(1)->null()->defaultValue(1),
                'created_at' => $this->integer(11)->null(),
                'updated_at' => $this->integer(11)->null(),
                'created_by' => $this->integer(11)->null()->defaultValue(1),
                'updated_by' => $this->integer(11)->null()->defaultValue(1),
            ], $tableOptions);
            $this->addColumn('social_fanpage', 'language', "ENUM('vi', 'en', 'jp') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'vi' COMMENT 'Language' AFTER `status`");
            $this->createIndex('index-slug', 'social_fanpage', 'slug');
            $this->createIndex('index-language', 'social_fanpage', 'language');
            $this->addForeignKey('fk_social_fanpage_created_by_user', 'social_fanpage', 'created_by', 'user', 'id', 'RESTRICT', 'CASCADE');
            $this->addForeignKey('fk_social_fanpage_updated_by_user', 'social_fanpage', 'updated_by', 'user', 'id', 'RESTRICT', 'CASCADE');
            $this->addForeignKey('fk_social_fanpage_origin_id_origin', 'social_fanpage', 'origin_id', 'social_origin', 'id', 'RESTRICT', 'CASCADE');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200603_080913_create_table_social_fanpage cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200603_080913_create_table_social_fanpage cannot be reverted.\n";

        return false;
    }
    */
}

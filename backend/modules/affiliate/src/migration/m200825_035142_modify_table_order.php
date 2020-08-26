<?php

use yii\db\Migration;

/**
 * Class m200825_035142_modify_table_order
 */
class m200825_035142_modify_table_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('affiliate_order', 'partner_order_code', $this->string()->null()->comment('Mã đơn hàng hệ thống partner'));
        $this->addColumn('affiliate_order', 'date_create', $this->integer(11)->notNull());
        $this->addColumn('affiliate_order', 'status', $this->smallInteger(2)->comment('0: Thanh toán, 1: Đặt cọc, 2: Hoàn cọc'));
        $this->addColumn('affiliate_order', 'payment_method', $this->string()->null());
        $this->addForeignKey('fk_af_order_customer_id_af_customer_id', 'affiliate_order', 'customer_id', 'affiliate_customer', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200825_035142_modify_table_order cannot be reverted.\n";

        return false;
    }

}
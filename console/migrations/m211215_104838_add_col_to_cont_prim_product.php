<?php

use yii\db\Migration;

/**
 * Class m211215_104838_add_col_to_cont_prim_product
 */
class m211215_104838_add_col_to_cont_prim_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('control_primary_product', 'product_type_id', $this->integer());

        $this->createIndex('index-control_primary_product-product_type_id', 'control_primary_product', 'product_type_id');
        $this->addForeignKey('fkey-control_primary_product-product_type_id', 'control_primary_product', 'product_type_id', 'product_types', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211215_104838_add_col_to_cont_prim_product cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211215_104838_add_col_to_cont_prim_product cannot be reverted.\n";

        return false;
    }
    */
}

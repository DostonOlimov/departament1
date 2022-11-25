<?php

use yii\db\Migration;

/**
 * Class m211214_064854_create_add_col_cont_prim_data
 */
class m211214_064854_create_add_col_cont_prim_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('control_primary_data', 'smt', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211214_064854_create_add_col_cont_prim_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211214_064854_create_add_col_cont_prim_data cannot be reverted.\n";

        return false;
    }
    */
}

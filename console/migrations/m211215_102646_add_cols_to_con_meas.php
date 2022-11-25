<?php

use yii\db\Migration;

/**
 * Class m211215_102646_add_cols_to_con_meas
 */
class m211215_102646_add_cols_to_con_meas extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('control_measures', 'ov_date', $this->bigInteger());
        $this->addColumn('control_measures', 'ov_quantity', $this->integer());
        $this->addColumn('control_measures', 'ov_name', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211215_102646_add_cols_to_con_meas cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211215_102646_add_cols_to_con_meas cannot be reverted.\n";

        return false;
    }
    */
}

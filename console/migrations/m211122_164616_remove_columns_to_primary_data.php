<?php

use yii\db\Migration;

/**
 * Class m211122_164616_remove_columns_to_primary_data
 */
class m211122_164616_remove_columns_to_primary_data extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('control_primary_data', 'count');
        $this->dropColumn('control_primary_data', 'compared_count');
        $this->dropColumn('control_primary_data', 'invalid_count');
        $this->dropColumn('control_primary_data', 'certificate');
        $this->addColumn('control_primary_data', 'laboratory', $this->integer()->notNull());
    }

    public function safeDown()
    {
        echo "m211122_164616_remove_columns_to_primary_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211122_164616_remove_columns_to_primary_data cannot be reverted.\n";

        return false;
    }
    */
}

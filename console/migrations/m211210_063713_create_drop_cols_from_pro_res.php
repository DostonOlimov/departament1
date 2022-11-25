<?php

use yii\db\Migration;

/**
 * Class m211210_063713_create_drop_cols_from_pro_res
 */
class m211210_063713_create_drop_cols_from_pro_res extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('pro_results' , 'help_count');
        $this->dropColumn('pro_results' , 'help_name');
        $this->dropColumn('pro_results' , 'standard_count');
        $this->dropColumn('pro_results' , 'standard_name');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211210_063713_create_drop_cols_from_pro_res cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211210_063713_create_drop_cols_from_pro_res cannot be reverted.\n";

        return false;
    }
    */
}

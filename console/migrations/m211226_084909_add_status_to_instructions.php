<?php

use yii\db\Migration;

/**
 * Class m211226_084909_add_status_to_companies
 */
class m211226_084909_add_status_to_instructions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('control_instructions', 'general_status', $this->integer()->notNull());
        $this->addColumn('pro_instructions', 'general_status', $this->integer()->notNull());
    }

    public function safeDown()
    {
        echo "m211226_084909_add_status_to_companies cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211226_084909_add_status_to_companies cannot be reverted.\n";

        return false;
    }
    */
}

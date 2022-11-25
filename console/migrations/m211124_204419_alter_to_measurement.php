<?php

use yii\db\Migration;

/**
 * Class m211124_204419_alter_to_measurement
 */
class m211124_204419_alter_to_measurement extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('control_measures', 'type');
        $this->addColumn('control_measures', 'type', $this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211124_204419_alter_to_measurement cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211124_204419_alter_to_measurement cannot be reverted.\n";

        return false;
    }
    */
}

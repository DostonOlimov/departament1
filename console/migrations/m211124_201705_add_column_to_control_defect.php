<?php

use yii\db\Migration;

/**
 * Class m211124_201705_add_column_to_control_defect
 */
class m211124_201705_add_column_to_control_defect extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('control_defects', 'compliance_quantity', $this->string());
        $this->addColumn('control_defects', 'compliance_cost', $this->string());
        $this->addColumn('control_defects', 'tex_quantity', $this->string());
        $this->addColumn('control_defects', 'tex_cost', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211124_201705_add_column_to_control_defect cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211124_201705_add_column_to_control_defect cannot be reverted.\n";

        return false;
    }
    */
}

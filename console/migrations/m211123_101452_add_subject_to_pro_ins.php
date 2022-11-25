<?php

use yii\db\Migration;

/**
 * Class m211123_101452_add_subject_to_pro_ins
 */
class m211123_101452_add_subject_to_pro_ins extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("pro_instructions", "subject", $this->integer());
        $this->addColumn("pro_instructions", "status", $this->integer());
        $this->addColumn("pro_instructions", "program_type", $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211123_101452_add_subject_to_pro_ins cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211123_101452_add_subject_to_pro_ins cannot be reverted.\n";

        return false;
    }
    */
}

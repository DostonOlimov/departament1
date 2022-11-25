<?php

use yii\db\Migration;

/**
 * Class m211124_063146_add_others_cols_to_ans
 */
class m211124_063146_add_others_cols_to_ans extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("pro_answers", "field_name", $this->string());
        $this->addColumn("pro_answers", "organization_name", $this->string());
        $this->addColumn("pro_answers", "reestr_number", $this->integer());
        $this->addColumn("pro_answers", "validity_period", $this->string());
        $this->addColumn("pro_answers", "has_labaratory", $this->string());
        $this->addColumn("pro_answers", "with_contract", $this->string());
        $this->addColumn("pro_answers", "hasnt_labaratory", $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211124_063146_add_others_cols_to_ans cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211124_063146_add_others_cols_to_ans cannot be reverted.\n";

        return false;
    }
    */
}

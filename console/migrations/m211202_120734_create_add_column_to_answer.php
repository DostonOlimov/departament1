<?php

use yii\db\Migration;

/**
 * Class m211202_120734_create_add_column_to_answer
 */
class m211202_120734_create_add_column_to_answer extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('pro_answers', 'all_instruments', $this->integer());
        $this->addColumn('pro_answers', 'expired_instruments', $this->integer());
        $this->addColumn('pro_answers', 'not_expired_instruments', $this->integer());
        $this->dropColumn("pro_answers", "level");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn("pro_answers", "all_instruments");
        $this->dropColumn("pro_answers", "expired_instruments");
        $this->dropColumn("pro_answers", "not_expired_instruments");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211202_120734_create_add_column_to_answer cannot be reverted.\n";

        return false;
    }
    */
}

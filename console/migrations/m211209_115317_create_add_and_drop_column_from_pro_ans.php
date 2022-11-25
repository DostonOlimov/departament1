<?php

use yii\db\Migration;

/**
 * Class m211209_115317_create_add_and_drop_column_from_pro_ans
 */
class m211209_115317_create_add_and_drop_column_from_pro_ans extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('pro_answer_standard_counts' , 'comment');
        $this->addColumn('pro_answer_standard_counts', 'category', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211209_115317_create_add_and_drop_column_from_pro_ans cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211209_115317_create_add_and_drop_column_from_pro_ans cannot be reverted.\n";

        return false;
    }
    */
}

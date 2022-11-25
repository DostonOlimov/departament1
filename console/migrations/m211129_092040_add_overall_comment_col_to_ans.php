<?php

use yii\db\Migration;

/**
 * Class m211129_092040_add_overall_comment_col_to_ans
 */
class m211129_092040_add_overall_comment_col_to_ans extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('pro_answers', 'overall_comment', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211129_092040_add_overall_comment_col_to_ans cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211129_092040_add_overall_comment_col_to_ans cannot be reverted.\n";

        return false;
    }
    */
}

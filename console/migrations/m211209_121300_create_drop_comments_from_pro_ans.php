<?php

use yii\db\Migration;

/**
 * Class m211209_121300_create_drop_comments_from_pro_ans
 */
class m211209_121300_create_drop_comments_from_pro_ans extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('pro_answers' , 'has_labaratory');
        $this->dropColumn('pro_answers' , 'with_contract');
        $this->dropColumn('pro_answers' , 'hasnt_labaratory');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211209_121300_create_drop_comments_from_pro_ans cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211209_121300_create_drop_comments_from_pro_ans cannot be reverted.\n";

        return false;
    }
    */
}

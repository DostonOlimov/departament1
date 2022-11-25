<?php

use yii\db\Migration;

/**
 * Class m211123_101452_drop_type_from_comp
 */
class m211123_101452_drop_type_from_comp extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn("pro_companies", "type");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211123_101452_drop_type_from_comp cannot be reverted.\n";

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




    // $this->dropColumn("pro_companies", "type");
}

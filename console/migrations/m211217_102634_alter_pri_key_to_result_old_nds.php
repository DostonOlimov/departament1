<?php

use yii\db\Migration;

/**
 * Class m211217_102634_alter_pri_key_to_result_old_nds
 */
class m211217_102634_alter_pri_key_to_result_old_nds extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fkey-result_old_nds-old_nd_id', 'result_old_nds');
        $this->dropIndex('index-result_old_nds-old_nd_id', 'result_old_nds');
        $this->dropColumn('result_old_nds', 'old_nd_id');

        $this->addColumn('result_old_nds', 'result_nd_id', $this->integer());
        $this->createIndex('index-result_old_nds-result_nd_id', 'result_old_nds', 'result_nd_id');
        $this->addForeignKey('fkey-result_old_nds-result_nd_id', 'result_old_nds', 'result_nd_id', 'result_nds', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211217_102634_alter_pri_key_to_result_old_nds cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211217_102634_alter_pri_key_to_result_old_nds cannot be reverted.\n";

        return false;
    }
    */
}

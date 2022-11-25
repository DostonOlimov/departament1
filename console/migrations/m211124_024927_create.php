<?php

use yii\db\Migration;

/**
 * Class m211124_024927_create
 */
class m211124_024927_create extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('laboratories', 'out_bayonnoma', $this->string());
        $this->addColumn('laboratories', 'out_dalolatnoma', $this->string());
        $this->addColumn('laboratories', 'finish_dalolatnoma', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211124_024927_create cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211124_024927_create cannot be reverted.\n";

        return false;
    }
    */
}

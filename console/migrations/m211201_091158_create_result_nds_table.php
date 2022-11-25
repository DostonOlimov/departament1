<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%result_nds}}`.
 */
class m211201_091158_create_result_nds_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%result_nds}}', [
            'id' => $this->primaryKey(),
            'result_id' => $this->integer(),
            'nd_id' => $this->integer(),
            'description' => $this->string(),
        ], $tableOptions);

        $this->createIndex('index-result_nds-result_id', 'result_nds', 'result_id');
        $this->addForeignKey('fkey-result_nds-result_id', 'result_nds', 'result_id', 'pro_results', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-result_nds-nd_id', 'result_nds', 'nd_id');
        $this->addForeignKey('fkey-result_nds-nd_id', 'result_nds', 'nd_id', 'nd', 'id', 'RESTRICT', 'RESTRICT');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%result_nds}}');
    }
}

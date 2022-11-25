<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pro_result_normatives}}`.
 */
class m211210_062536_create_pro_result_normatives_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%pro_result_normatives}}', [
            'id' => $this->primaryKey(),
            'pro_result_id' => $this->integer(),
            'nd_id' => $this->integer(),
            'help_name' => $this->string(),
        ], $tableOptions);

        $this->createIndex('index-pro_result_normatives-pro_result_id', 'pro_result_normatives', 'pro_result_id');
        $this->addForeignKey('fkey-pro_result_normatives-pro_result_id', 'pro_result_normatives', 'pro_result_id', 'pro_results', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-pro_result_normatives-nd_id', 'pro_result_normatives', 'nd_id');
        $this->addForeignKey('fkey-pro_result_normatives-nd_id', 'pro_result_normatives', 'nd_id', 'nd', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pro_result_normatives}}');
    }
}

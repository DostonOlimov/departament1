<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pro_result_standarts}}`.
 */
class m211210_071041_create_pro_result_standarts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%pro_result_standarts}}', [
            'id' => $this->primaryKey(),
            'pro_result_id' =>$this->integer(),
            'nd_id' => $this->integer(),
            'standard_name' => $this->string(),
        ],$tableOptions);

        $this->createIndex('index-pro_result_standarts-pro_result_id', 'pro_result_standarts', 'pro_result_id');
        $this->addForeignKey('fkey-pro_result_standarts-pro_result_id', 'pro_result_standarts', 'pro_result_id', 'pro_results', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-pro_result_standarts-nd_id', 'pro_result_standarts', 'nd_id');
        $this->addForeignKey('fkey-pro_result_standarts-nd_id', 'pro_result_standarts', 'nd_id', 'nd', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pro_result_standarts}}');
    }
}

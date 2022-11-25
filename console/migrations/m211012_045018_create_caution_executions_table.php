<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%caution_executions}}`.
 */
class m211012_045018_create_caution_executions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%caution_executions}}', [
            'id' => $this->primaryKey(),
            'caution_company_id' => $this->integer()->notNull(),
            'date' => $this->integer(),
            'number' => $this->integer(),
            'description' => $this->text(),
            'deficiency' => $this->boolean(),

            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);
        
        $this->createIndex('index-caution_executions-caution_company_id', 'caution_executions', 'caution_company_id');
        $this->addForeignKey('fkey-caution_executions-caution_company_id', 'caution_executions', 'caution_company_id', 'caution_companies', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-caution_executions-created_by', 'caution_executions', 'created_by');
        $this->addForeignKey('fkey-caution_executions-created_by', 'caution_executions', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-caution_executions-updated_by', 'caution_executions', 'updated_by');
        $this->addForeignKey('fkey-caution_executions-updated_by', 'caution_executions', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%caution_executions}}');
    }
}

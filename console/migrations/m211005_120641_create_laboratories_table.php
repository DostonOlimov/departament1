<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%laboratories}}`.
 */
class m211005_120641_create_laboratories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%laboratories}}', [
            'id' => $this->primaryKey(),
            'control_company_id' => $this->integer()->notNull(),
            'dalolatnoma' => $this->string(),
            'bayonnoma' => $this->string(),

            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->createIndex('index-laboratories-control_company_id', 'laboratories', 'control_company_id');
        $this->addForeignKey('fkey-laboratories-control_company_id', 'laboratories', 'control_company_id', 'control_companies', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-laboratories-created_by', 'laboratories', 'created_by');
        $this->addForeignKey('fkey-laboratories-created_by', 'laboratories', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-laboratories-updated_by', 'laboratories', 'updated_by');
        $this->addForeignKey('fkey-laboratories-updated_by', 'laboratories', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%laboratories}}');
    }
}

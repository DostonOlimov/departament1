<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%control_cautions}}`.
 */
class m211125_025724_create_control_cautions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%control_cautions}}', [
            'id' => $this->primaryKey(),
            'control_company_id' => $this->integer(),
            'caution' => $this->string(),
            'caution_date' => $this->integer(),
            'caution_number' => $this->string(),
            'file' => $this->string(),
            'description' => $this->string(),

            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);
        $this->createIndex('index-control_cautions-company_id', 'control_cautions', 'control_company_id');
        $this->addForeignKey('fkey-control_cautions-company_id', 'control_cautions', 'control_company_id', 'control_companies', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-control_cautions-created_by', 'control_cautions', 'created_by');
        $this->addForeignKey('fkey-control_cautions-created_by', 'control_cautions', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-control_cautions-updated_by', 'control_cautions', 'updated_by');
        $this->addForeignKey('fkey-control_cautions-updated_by', 'control_cautions', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%control_cautions}}');
    }
}

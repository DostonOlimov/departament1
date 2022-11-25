<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%control_company}}`.
 */
class m211005_120640_create_control_companies_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%control_companies}}', [
            'id' => $this->primaryKey(),
            'control_instruction_id' => $this->integer()->notNull(),
            'region_id' => $this->integer(),
            'name' => $this->string(),
            'inn' => $this->integer(),
            'soogu' => $this->integer(),
            'type' => $this->string(),
            'phone' => $this->bigInteger(),
            'link' => $this->string(),
            'address' => $this->string(),

            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->createIndex('index-control_companies-control_instruction_id', 'control_companies', 'control_instruction_id');
        $this->addForeignKey('fkey-control_companies-control_instruction_id', 'control_companies', 'control_instruction_id', 'control_instructions', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-control_companies-region_id', 'control_companies', 'region_id');
        $this->addForeignKey('fkey-control_companies-region_id', 'control_companies', 'region_id', 'regions', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-control_companies-created_by', 'control_companies', 'created_by');
        $this->addForeignKey('fkey-control_companies-created_by', 'control_companies', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-control_companies-updated_by', 'control_companies', 'updated_by');
        $this->addForeignKey('fkey-control_companies-updated_by', 'control_companies', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%control_companies}}');
    }
}

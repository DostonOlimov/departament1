<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%caution_companies}}`.
 */
class m211012_040435_create_caution_companies_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%caution_companies}}', [
            'id' => $this->primaryKey(),
            'caution_instruction_id' => $this->integer()->notNull(),
            'region_id' => $this->integer()->notNull(),
            'name' => $this->string(),
            'inn' => $this->integer(),
            'type' => $this->string(),
            'phone' => $this->bigInteger(),
            'link' => $this->string(),
            'address' => $this->string(),

            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->createIndex('index-caution_companies-region_id', 'caution_companies', 'region_id');
        $this->addForeignKey('fkey-caution_companies-region_id', 'caution_companies', 'region_id', 'regions', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-caution_companies-caution_instruction_id', 'caution_companies', 'caution_instruction_id');
        $this->addForeignKey('fkey-caution_companies-caution_instruction_id', 'caution_companies', 'caution_instruction_id', 'caution_instructions', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-caution_companies-created_by', 'caution_companies', 'created_by');
        $this->addForeignKey('fkey-caution_companies-created_by', 'caution_companies', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-caution_companies-updated_by', 'caution_companies', 'updated_by');
        $this->addForeignKey('fkey-caution_companies-updated_by', 'caution_companies', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropTable('{{%caution_companies}}');
    }
}

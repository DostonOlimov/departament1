<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shopping_companies}}`.
 */
class m211011_055820_create_shopping_companies_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shopping_companies}}', [
            'id' => $this->primaryKey(),
            'shopping_instruction_id' => $this->integer()->notNull(),
            'region_id' => $this->integer(),
            'name' => $this->string()->notNull(),
            'inn' => $this->integer(),
            'after' => $this->string(),
            'phone' => $this->bigInteger(),
            'link' => $this->string(),
            'address' => $this->string(),

            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->createIndex('index-shopping_companies-shopping_instruction_id', 'shopping_companies', 'shopping_instruction_id');
        $this->addForeignKey('fkey-shopping_companies-shopping_instruction_id', 'shopping_companies', 'shopping_instruction_id', 'shopping_instructions', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-shopping_companies-region_id', 'shopping_companies', 'region_id');
        $this->addForeignKey('fkey-shopping_companies-region_id', 'shopping_companies', 'region_id', 'regions', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-shopping_companies-created_by', 'shopping_companies', 'created_by');
        $this->addForeignKey('fkey-shopping_companies-created_by', 'shopping_companies', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-shopping_companies-updated_by', 'shopping_companies', 'updated_by');
        $this->addForeignKey('fkey-shopping_companies-updated_by', 'shopping_companies', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shopping_companies}}');
    }
}

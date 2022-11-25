<?php

use yii\db\Migration;

class m211011_052214_create_shopping_instructions_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%shopping_instructions}}', [
            'id' => $this->primaryKey(),
            'base' => $this->integer(),
            'letter_date' => $this->integer(),
            'letter_number' => $this->string(),

            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->createIndex('index-shopping_instructions-created_by', 'shopping_instructions', 'created_by');
        $this->addForeignKey('fkey-shopping_instructions-created_by', 'shopping_instructions', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-shopping_instructions-updated_by', 'shopping_instructions', 'updated_by');
        $this->addForeignKey('fkey-shopping_instructions-updated_by', 'shopping_instructions', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropTable('{{%shopping_instructions}}');
    }
}

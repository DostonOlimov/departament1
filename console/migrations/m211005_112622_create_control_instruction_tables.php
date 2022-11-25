<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%control_instruction}}`.
 */
class m211005_112622_create_control_instruction_tables extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%control_instructions}}', [
            'id' => $this->primaryKey(),
            'base' => $this->integer(),
            'letter_date' => $this->integer(),
            'letter_number' => $this->string(),
            'command_date' => $this->integer(),
            'command_number' => $this->string(),
            'checkup_begin_date' => $this->integer(),
            'checkup_finish_date' => $this->integer(),

            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->createIndex('index-control_instructions-created_by', 'control_instructions', 'created_by');
        $this->addForeignKey('fkey-control_instructions-created_by', 'control_instructions', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-control_instructions-updated_by', 'control_instructions', 'updated_by');
        $this->addForeignKey('fkey-control_instructions-updated_by', 'control_instructions', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropTable('{{%control_instructions}}');
    }
}

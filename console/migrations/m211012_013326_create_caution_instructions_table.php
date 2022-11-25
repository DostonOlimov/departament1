<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%caution_instructions}}`.
 */
class m211012_013326_create_caution_instructions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%caution_instructions}}', [
            'id' => $this->primaryKey(),
            'base' => $this->integer(),
            'letter_date' => $this->integer(),
            'letter_number' => $this->string(),

            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->createIndex('index-caution_instructions-created_by', 'caution_instructions', 'created_by');
        $this->addForeignKey('fkey-caution_instructions-created_by', 'caution_instructions', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-caution_instructions-updated_by', 'caution_instructions', 'updated_by');
        $this->addForeignKey('fkey-caution_instructions-updated_by', 'caution_instructions', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%caution_instructions}}');
    }
}

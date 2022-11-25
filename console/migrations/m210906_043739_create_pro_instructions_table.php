<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%instructions}}`.
 */
class m210906_043739_create_pro_instructions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pro_instructions}}', [
            'id' => $this->primaryKey(),
            'base' => $this->integer(),
            'letter_date' => $this->integer(),
            'letter_number' => $this->string(),

            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->createIndex('index-pro_instructions-created_by', 'pro_instructions', 'created_by');
        $this->addForeignKey('fkey-pro_instructions-created_by', 'pro_instructions', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-pro_instructions-updated_by', 'pro_instructions', 'updated_by');
        $this->addForeignKey('fkey-pro_instructions-updated_by', 'pro_instructions', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pro_instructions}}');
    }
}

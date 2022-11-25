<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%instruction_users}}`.
 */
class m211215_043530_create_instruction_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%instruction_users}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'instruction_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('index-instruction_users-user_id', 'instruction_users', 'user_id');
        $this->addForeignKey('fkey-instruction_users-user_id', 'instruction_users', 'user_id', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-instruction_users-instruction_id', 'instruction_users', 'instruction_id');
        $this->addForeignKey('fkey-instruction_users-instruction_id', 'instruction_users', 'instruction_id', 'control_instructions', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%instruction_users}}');
    }
}

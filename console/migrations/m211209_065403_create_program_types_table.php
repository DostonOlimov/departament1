<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%program_types}}`.
 */
class m211209_065403_create_program_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%program_types}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),

            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);

        $this->createIndex('index-program_types-created_by', 'program_types', 'created_by');
        $this->addForeignKey('fkey-program_types-created_by', 'program_types', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-program_types-updated_by', 'program_types', 'updated_by');
        $this->addForeignKey('fkey-program_types-updated_by', 'program_types', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%program_types}}');
    }
}



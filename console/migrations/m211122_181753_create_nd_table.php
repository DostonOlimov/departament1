<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%nd}}`.
 */
class m211122_181753_create_nd_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%nd}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),

            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);
        
        $this->createIndex('index-nd-created_by', 'nd', 'created_by');
        $this->addForeignKey('fkey-nd-created_by', 'nd', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-nd-updated_by', 'nd', 'updated_by');
        $this->addForeignKey('fkey-nd-updated_by', 'nd', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%nd}}');
    }
}

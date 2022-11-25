<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%nd_type}}`.
 */
class m211122_181806_create_nd_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%nd_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),

            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);
        
        $this->createIndex('index-nd_type-created_by', 'nd_type', 'created_by');
        $this->addForeignKey('fkey-nd_type-created_by', 'nd_type', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-nd_type-updated_by', 'nd_type', 'updated_by');
        $this->addForeignKey('fkey-nd_type-updated_by', 'nd_type', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%nd_type}}');
    }
}

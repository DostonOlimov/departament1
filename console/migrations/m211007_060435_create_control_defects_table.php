<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%control_defects}}`.
 */
class m211007_060435_create_control_defects_table extends Migration
{
    public function safeUp()
    {

        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%control_defects}}', [
            'id' => $this->primaryKey(),
            'control_company_id' => $this->integer()->notNull(),
            'type' => $this->string(),
            'description' => $this->text(),

            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);

        $this->createIndex('index-control_defects-control_company_id', 'control_defects', 'control_company_id');
        $this->addForeignKey('fkey-control_defects-control_company_id', 'control_defects', 'control_company_id', 'control_companies', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-control_defects-created_by', 'control_defects', 'created_by');
        $this->addForeignKey('fkey-control_defects-created_by', 'control_defects', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-control_defects-updated_by', 'control_defects', 'updated_by');
        $this->addForeignKey('fkey-control_defects-updated_by', 'control_defects', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%control_defects}}');
    }
}

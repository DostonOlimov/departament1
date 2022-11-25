<?php

use yii\db\Migration;

class m211006_110008_create_control_identifications_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%control_identifications}}', [
            'id' => $this->primaryKey(),
            'control_company_id' => $this->integer()->notNull(),
            'file' => $this->string(),
            'identification' => $this->string(),

            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->createIndex('index-control_identifications-control_company_id', 'control_identifications', 'control_company_id');
        $this->addForeignKey('fkey-control_identifications-control_company_id', 'control_identifications', 'control_company_id', 'control_companies', 'id', 'RESTRICT', 'RESTRICT');
        
        $this->createIndex('index-control_identifications-created_by', 'control_identifications', 'created_by');
        $this->addForeignKey('fkey-control_identifications-created_by', 'control_identifications', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-control_identifications-updated_by', 'control_identifications', 'updated_by');
        $this->addForeignKey('fkey-control_identifications-updated_by', 'control_identifications', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropTable('{{%control_identifications}}');
    }
}

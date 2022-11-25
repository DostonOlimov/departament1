<?php

use yii\db\Migration;

class m211007_070704_create_control_measures_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%control_measures}}', [
            'id' => $this->primaryKey(),
            'control_company_id' => $this->integer()->notNull(),
            'type' => $this->integer(),
            'date' => $this->bigInteger(),
            'quantity' => $this->integer(),
            'amount' => $this->integer(),
            'person' => $this->string(),
            'number_passport' => $this->string(),
            'fine_amount' => $this->integer(),

            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->createIndex('index-control_measures-control_company_id', 'control_measures', 'control_company_id');
        $this->addForeignKey('fkey-control_measures-control_company_id', 'control_measures', 'control_company_id', 'control_companies', 'id', 'RESTRICT', 'RESTRICT');
        
        $this->createIndex('index-control_measures-created_by', 'control_measures', 'created_by');
        $this->addForeignKey('fkey-control_measures-created_by', 'control_measures', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-control_measures-updated_by', 'control_measures', 'updated_by');
        $this->addForeignKey('fkey-control_measures-updated_by', 'control_measures', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropTable('{{%control_measures}}');
    }
}

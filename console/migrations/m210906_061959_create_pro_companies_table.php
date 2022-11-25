<?php

use yii\db\Migration;

class m210906_061959_create_pro_companies_table extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%pro_companies}}', [
            'id' => $this->primaryKey(),
            'pro_instruction_id' => $this->integer()->notNull(),
            'region_id' => $this->integer(),
            'name' => $this->string()->notNull(),
            'inn' => $this->integer(),
            'type' => $this->string(),
            'phone' => $this->bigInteger(),
            'link' => $this->string(),
            'address' => $this->string(),

            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->createIndex('index-pro_companies-pro_instruction_id', 'pro_companies', 'pro_instruction_id');
        $this->addForeignKey('fkey-pro_companies-pro_instruction_id', 'pro_companies', 'pro_instruction_id', 'pro_instructions', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-pro_companies-region_id', 'pro_companies', 'region_id');
        $this->addForeignKey('fkey-pro_companies-region_id', 'pro_companies', 'region_id', 'regions', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-pro_companies-created_by', 'pro_companies', 'created_by');
        $this->addForeignKey('fkey-pro_companies-created_by', 'pro_companies', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-pro_companies-updated_by', 'pro_companies', 'updated_by');
        $this->addForeignKey('fkey-pro_companies-updated_by', 'pro_companies', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropTable('{{%pro_companies}}');
    }
}

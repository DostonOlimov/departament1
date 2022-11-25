<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%control_primary_data}}`.
 */
class m211005_125429_create_control_primary_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%control_primary_data}}', [
            'id' => $this->primaryKey(),
            'control_company_id' => $this->integer()->notNull(),
            'count' => $this->integer(),
            'compared_count' => $this->integer(),
            'invalid_count' => $this->integer(),
            'certificate' => $this->string(),
            'residue_quantity' => $this->string(),
            'residue_amount' => $this->string(),
            'potency' => $this->string(),
            'year_quantity' => $this->string(),
            'year_amount' => $this->string(),

            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->createIndex('index-control_primary_data-control_company_id', 'control_primary_data', 'control_company_id');
        $this->addForeignKey('fkey-control_primary_data-control_company_id', 'control_primary_data', 'control_company_id', 'control_companies', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-control_primary_data-created_by', 'control_primary_data', 'created_by');
        $this->addForeignKey('fkey-control_primary_data-created_by', 'control_primary_data', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-control_primary_data-updated_by', 'control_primary_data', 'updated_by');
        $this->addForeignKey('fkey-control_primary_data-updated_by', 'control_primary_data', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropTable('{{%control_primary_data}}');
    }
}

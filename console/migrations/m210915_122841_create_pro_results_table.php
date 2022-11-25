<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pro_results}}`.
 */
class m210915_122841_create_pro_results_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pro_results}}', [
            'id' => $this->primaryKey(),
            'pro_company_id' => $this->integer(),
            'help_name' => $this->string(),
            'help_count' => $this->integer(),
            'active_name' => $this->string(),
            'active_count' => $this->integer(),
            'standard_name' => $this->string(),
            'standard_count' => $this->integer(),
            'certificate_help' => $this->string(),
            'certificate_text' => $this->text(),
            'measure_help_name' => $this->string(),
            'measure_help_count' => $this->integer(),
            'import_export' => $this->boolean(),
            'import_export_text' => $this->text(),
            'smk' => $this->string(),
            'smk_text' => $this->string(),
            'decision' => $this->string(),
            'decision_text' => $this->text(),
            'problem' => $this->string(),
            'people' => $this->string(),

            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->createIndex('index-pro_results-pro_company_id', 'pro_results', 'pro_company_id');
        $this->addForeignKey('fkey-pro_results-pro_company_id', 'pro_results', 'pro_company_id', 'pro_companies', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-pro_results-created_by', 'pro_results', 'created_by');
        $this->addForeignKey('fkey-pro_results-created_by', 'pro_results', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-pro_results-updated_by', 'pro_results', 'updated_by');
        $this->addForeignKey('fkey-pro_results-updated_by', 'pro_results', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropTable('{{%pro_results}}');
    }
}

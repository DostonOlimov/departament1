<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pro_answers}}`.
 */
class m210915_064509_create_pro_answers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pro_answers}}', [
            'id' => $this->primaryKey(),
            'pro_company_id' => $this->integer()->notNull(),
            'product_name' => $this->string(),
            'internation_standard' => $this->string(),
            'product_quality' => $this->string(),
            'employee' => $this->string(),
            'smk' => $this->string(),
            'international_certificate' => $this->string(),
            'level' => $this->string(),
            'import_export' => $this->boolean(),
            'import_export_product' => $this->string(500),
            'lab_check' => $this->integer(),

            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->createIndex('index-pro_answers-pro_company_id', 'pro_answers', 'pro_company_id');
        $this->addForeignKey('fkey-pro_answers-pro_company_id', 'pro_answers', 'pro_company_id', 'pro_companies', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-pro_answers-created_by', 'pro_answers', 'created_by');
        $this->addForeignKey('fkey-pro_answers-created_by', 'pro_answers', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-pro_answers-updated_by', 'pro_answers', 'updated_by');
        $this->addForeignKey('fkey-pro_answers-updated_by', 'pro_answers', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pro_answers}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%disorders}}`.
 */
class m211123_112948_create_disorders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%disorders}}', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer()->notNull(),
            'standart' => $this->text(),
            'certificate' => $this->text(),
            'metrologic' => $this->text(),
        ]);

        $this->createIndex('index-disorders-company_id', 'disorders', 'company_id');
        $this->addForeignKey('fkey-disorders-company_id', 'disorders', 'company_id', 'pro_companies', 'id', 'RESTRICT', 'RESTRICT');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%disorders}}');
    }
}

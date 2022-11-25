<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pro_results_countries}}`.
 */
class m211004_112719_create_pro_results_countries_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pro_results_countries}}', [
            'id' => $this->primaryKey(),
            'pro_result_id' => $this->integer(),
            'country_id' => $this->integer(),
        ]);

        $this->createIndex('index-pro_results_countries-country_id', 'pro_results_countries', 'country_id');
        $this->addForeignKey('fkey-pro_results_countries-country_id', 'pro_results_countries', 'country_id', 'countries', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-pro_results_countries-pro_result_id', 'pro_results_countries', 'pro_result_id');
        $this->addForeignKey('fkey-pro_results_countries-pro_result_id', 'pro_results_countries', 'pro_result_id', 'pro_results', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pro_results_countries}}');
    }
}

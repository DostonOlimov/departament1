<?php

use yii\db\Migration;

class m210928_065939_create_pro_answer_countries_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%pro_answer_countries}}', [
            'id' => $this->primaryKey(),
            'country_id' => $this->integer()->notNull(),
            'pro_answer_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex('index-pro_answer_countries-country_id', 'pro_answer_countries', 'country_id');
        $this->addForeignKey('fkey-pro_answer_countries-country_id', 'pro_answer_countries', 'country_id', 'countries', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-pro_answer_countries-pro_answer_id', 'pro_answer_countries', 'pro_answer_id');
        $this->addForeignKey('fkey-pro_answer_countries-pro_answer_id', 'pro_answer_countries', 'pro_answer_id', 'pro_answers', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropTable('{{%pro_answer_countries}}');
    }
}

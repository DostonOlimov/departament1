<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pro_anwer_standard_counts}}`.
 */
class m210928_065959_create_pro_answer_standard_counts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pro_answer_standard_counts}}', [
            'id' => $this->primaryKey(),
            'pro_answer_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'type' => $this->integer()->notNull(),
        ]);

        $this->createIndex('index-pro_answer_standard_counts-pro_answer_id', 'pro_answer_standard_counts', 'pro_answer_id');
        $this->addForeignKey('fkey-pro_answer_standard_counts-pro_answer_id', 'pro_answer_standard_counts', 'pro_answer_id', 'pro_answers', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropTable('{{%pro_answer_standard_counts}}');
    }
}

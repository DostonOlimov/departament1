<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%pro_answers}}`.
 */
class m220113_104407_add_product_type_id_column_to_pro_answers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%pro_answers}}', 'product_type_id', $this->integer());

        $this->createIndex(
            'idx-pro_answers-product_type_id',
            'pro_answers',
            'product_type_id'
        );

        $this->addForeignKey(
            'fk-pro_answers-product_type_id',
            'pro_answers',
            'product_type_id',
            'product_types',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%pro_answers}}', 'product_type_id');
    }
}

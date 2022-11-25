<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pro_primary_data}}`.
 */
class m211214_044130_create_pro_primary_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        
        $this->createTable('{{%pro_primary_data}}', [
            'id' => $this->primaryKey(),
            'control_primary_id' => $this->integer(),
            'product_name' => $this->string(),
            'product_date' => $this->bigInteger(),
            ],$tableOptions);

        $this->createIndex('index-pro_primary_data-control_primary_id', 'pro_primary_data', 'control_primary_id');
        $this->addForeignKey('fkey-pro_primary_data-control_primary_id', 'pro_primary_data', 'control_primary_id', 'control_primary_product', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pro_primary_data}}');
    }
}

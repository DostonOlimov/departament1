<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shopping_products}}`.
 */
class m211011_065840_create_shopping_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shopping_products}}', [
            'id' => $this->primaryKey(),
            'shopping_company_id' => $this->integer()->notNull(),
            'name' => $this->string(),
            'quantity' => $this->integer(),
            'cost' => $this->integer(),
            'photo' => $this->string(),
            'photo_chek' => $this->string(),

            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->createIndex('index-shopping_products-shopping_company_id', 'shopping_products', 'shopping_company_id');
        $this->addForeignKey('fkey-shopping_products-shopping_company_id', 'shopping_products', 'shopping_company_id', 'shopping_companies', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-shopping_products-created_by', 'shopping_products', 'created_by');
        $this->addForeignKey('fkey-shopping_products-created_by', 'shopping_products', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-shopping_products-updated_by', 'shopping_products', 'updated_by');
        $this->addForeignKey('fkey-shopping_products-updated_by', 'shopping_products', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shopping_products}}');
    }
}

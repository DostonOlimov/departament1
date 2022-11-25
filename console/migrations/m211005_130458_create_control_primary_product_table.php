<?php

use yii\db\Migration;

class m211005_130458_create_control_primary_product_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%control_primary_product}}', [
            'id' => $this->primaryKey(),
            'control_primary_data_id' => $this->integer()->notNull(),
            'product_type' => $this->string(),
            'nd' => $this->string(),
            'nd_type' => $this->string(),
            'number_blank' => $this->string(),
            'number_reestr' => $this->string(),
            'date_from' => $this->bigInteger(),
            'date_to' => $this->bigInteger(),
        ]);

        $this->createIndex('index-control_primary_product-control_company_id', 'control_primary_product', 'control_primary_data_id');
        $this->addForeignKey('fkey-control_primary_product-control_company_id', 'control_primary_product', 'control_primary_data_id', 'control_primary_data', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropTable('{{%control_primary_product}}');
    }
}

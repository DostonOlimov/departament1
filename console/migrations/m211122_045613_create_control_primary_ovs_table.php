<?php

use yii\db\Migration;

class m211122_045613_create_control_primary_ovs_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%control_primary_ovs}}', [
            'id' => $this->primaryKey(),
            'control_primary_data_id' => $this->integer()->notNull(),
            'type' => $this->integer()->notNull(),
            'measurement' => $this->string()->notNull(),
            'compared' => $this->string()->notNull(),
            'invalid' => $this->string()->notNull(),
        ]);

        $this->createIndex('index-control_primary_ovs-control_company_id', 'control_primary_ovs', 'control_primary_data_id');
        $this->addForeignKey('fkey-control_primary_ovs-control_company_id', 'control_primary_ovs', 'control_primary_data_id', 'control_primary_data', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropTable('{{%control_primary_ovs}}');
    }
}

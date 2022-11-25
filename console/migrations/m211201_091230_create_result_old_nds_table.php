<?php

use yii\db\Migration;

class m211201_091230_create_result_old_nds_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%result_old_nds}}', [
            'id' => $this->primaryKey(),
            'nd_id' => $this->integer(),
            'old_nd_id' => $this->integer(),
            'description' => $this->string(),
        ], $tableOptions);

        $this->createIndex('index-result_old_nds-old_nd_id', 'result_old_nds', 'old_nd_id');
        $this->addForeignKey('fkey-result_old_nds-old_nd_id', 'result_old_nds', 'old_nd_id', 'nd', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-result_old_nds-nd_id', 'result_old_nds', 'nd_id');
        $this->addForeignKey('fkey-result_old_nds-nd_id', 'result_old_nds', 'nd_id', 'nd', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropTable('{{%result_old_nds}}');
    }
}

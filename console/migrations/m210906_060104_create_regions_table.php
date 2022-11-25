<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%regions}}`.
 */
class m210906_060104_create_regions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%regions}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),

            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->insert('regions', [
            'name' => 'Toshketn shahar',
            'created_at' => time(),
            'updated_at' => time(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $this->insert('regions', [
            'name' => 'Buxoro viloyati',
            'created_at' => time(),
            'updated_at' => time(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $this->insert('regions', [
            'name' => 'Andijon viloyati',
            'created_at' => time(),
            'updated_at' => time(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $this->insert('regions', [
            'name' => 'Navoiy viloyati',
            'created_at' => time(),
            'updated_at' => time(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $this->insert('regions', [
            'name' => 'Surxandaryo viloyati',
            'created_at' => time(),
            'updated_at' => time(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $this->insert('regions', [
            'name' => 'Qashqadaryo viloyati',
            'created_at' => time(),
            'updated_at' => time(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $this->insert('regions', [
            'name' => 'Namangan viloyati',
            'created_at' => time(),
            'updated_at' => time(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $this->insert('regions', [
            'name' => 'Farg\'ona viloyati',
            'created_at' => time(),
            'updated_at' => time(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $this->insert('regions', [
            'name' => 'Qoraqalpog\'iston respublikasi',
            'created_at' => time(),
            'updated_at' => time(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $this->insert('regions', [
            'name' => 'Sirdaryo viloyati',
            'created_at' => time(),
            'updated_at' => time(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $this->insert('regions', [
            'name' => 'Jizzax viloyati',
            'created_at' => time(),
            'updated_at' => time(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $this->insert('regions', [
            'name' => 'Samarqand viloyati',
            'created_at' => time(),
            'updated_at' => time(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $this->insert('regions', [
            'name' => 'Toshkent viloyati',
            'created_at' => time(),
            'updated_at' => time(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $this->insert('regions', [
            'name' => 'Xorazm viloyati',
            'created_at' => time(),
            'updated_at' => time(),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $this->createIndex('index-regions-created_by', 'regions', 'created_by');
        $this->addForeignKey('fkey-regions-created_by', 'regions', 'created_by', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createIndex('index-regions-updated_by', 'regions', 'updated_by');
        $this->addForeignKey('fkey-regions-updated_by', 'regions', 'updated_by', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropTable('{{%regions}}');
    }
}

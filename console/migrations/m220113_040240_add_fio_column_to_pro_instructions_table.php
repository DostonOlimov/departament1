<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%pro_instructions}}`.
 */
class m220113_040240_add_fio_column_to_pro_instructions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%pro_instructions}}', 'fio', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%pro_instructions}}', 'fio');
    }
}

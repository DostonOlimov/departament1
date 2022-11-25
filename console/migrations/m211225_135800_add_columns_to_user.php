<?php

use yii\db\Migration;

/**
 * Class m211225_135800_add_columns_to_user
 */
class m211225_135800_add_columns_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('user', 'email');
        $this->addColumn('user', 'name', $this->string());
        $this->addColumn('user', 'surname', $this->string());
        $this->addColumn('user', 'fathers_name', $this->string());
        $this->addColumn('user', 'role', $this->string());
        $this->addColumn('user', 'phone', $this->bigInteger());
    }

    public function safeDown()
    {
        $this->dropColumn('user', 'name');
        $this->dropColumn('user', 'surname');
        $this->dropColumn('user', 'fathers_name');
        $this->dropColumn('user', 'role');

    }

}

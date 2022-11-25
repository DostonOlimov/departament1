<?php

use yii\db\Migration;

/**
 * Class m211216_130311_add_col_to_prim_prod
 */
class m211216_130311_add_col_to_prim_prod extends Migration
{
    public function safeUp()
    {
        $this->addColumn('control_primary_product', 'product_name', $this->string());
    }

    public function safeDown()
    {
        echo "m211216_130311_add_col_to_prim_prod cannot be reverted.\n";

        return false;
    }
}

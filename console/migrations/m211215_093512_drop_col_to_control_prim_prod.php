<?php

use yii\db\Migration;

/**
 * Class m211215_093512_drop_col_to_control_prim_prod
 */
class m211215_093512_drop_col_to_control_prim_prod extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('control_primary_product' , 'product_type');
    }

    public function safeDown()
    {
        echo "m211215_093512_drop_col_to_control_prim_prod cannot be reverted.\n";
        return false;
    }
}

<?php

use yii\db\Migration;

/**
 * Class m211124_064510_add_import_and_export_products_cols_to_ans
 */
class m211124_064510_add_import_and_export_products_cols_to_ans extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('pro_answers', 'import_product', $this->string(1000));
        $this->addColumn('pro_answers', 'export_product', $this->string(1000));
        $this->dropColumn('pro_answers', 'lab_check');
        $this->addColumn('pro_answers', 'lab_check', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211124_064510_add_import_and_export_products_cols_to_ans cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211124_064510_add_import_and_export_products_cols_to_ans cannot be reverted.\n";

        return false;
    }
    */
}

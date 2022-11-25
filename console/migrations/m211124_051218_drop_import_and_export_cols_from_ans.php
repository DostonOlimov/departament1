<?php

use yii\db\Migration;

/**
 * Class m211124_051218_drop_import_and_export_cols_from_ans
 */
class m211124_051218_drop_import_and_export_cols_from_ans extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn("pro_answers", "import_export");
        $this->dropColumn("pro_answers", "import_export_product");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211124_051218_drop_import_and_export_cols_from_ans cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211124_051218_drop_import_and_export_cols_from_ans cannot be reverted.\n";

        return false;
    }
    */
}

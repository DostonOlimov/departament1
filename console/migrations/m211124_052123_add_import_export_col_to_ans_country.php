<?php

use yii\db\Migration;

/**
 * Class m211124_052123_add_import_export_col_to_ans_country
 */
class m211124_052123_add_import_export_col_to_ans_country extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("pro_answer_countries", "import_export", $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211124_052123_add_import_export_col_to_ans_country cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211124_052123_add_import_export_col_to_ans_country cannot be reverted.\n";

        return false;
    }
    */
}

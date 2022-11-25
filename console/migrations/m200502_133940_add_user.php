<?php
use common\models\User;
use yii\db\Migration;

/**
 * Class m200502_133940_add_user
 */
class m200502_133940_add_user extends Migration
{
    public function safeUp()
    {
        $this->insert('user', [
            'username' => 'adm!n',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('1q2w3e4r5t'),
            'email' => 'a@a.a',
            'status' => User::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    public function safeDown()
    {
        echo "m200502_133940_add_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200502_133940_add_user cannot be reverted.\n";

        return false;
    }
    */
}

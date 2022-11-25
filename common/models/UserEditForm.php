<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

class UserEditForm extends \yii\base\Model
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public $id;
    public $pass;
    public $username;
    public $name;
    public $surname;
    public $fathers_name;
    public $phone;
    public $role;

    public function __construct($id, $config = [])
    {
        $this->id = $id;
        parent::__construct($config);
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'pass' => 'Parol',
            'phone' => 'Telefon raqami',
            'name' => 'Ismi',
            'surname' => 'Familiyasi',
            'fathers_name' => 'Otasining ismi',
            'role' => 'Rol',
        ];
    }

    public static function rolesList()
    {
        return ArrayHelper::map(\Yii::$app->authManager->getRoles(), 'name', 'description');
    }


    public function rules()
    {
        return [
            ['username', 'string', 'min' => 3, 'max' => 255],
            [['username', 'email'], 'unique', 'targetClass' => User::class, 'filter' => ['<>', 'id', $this->id]],

            [['name', 'surname', 'fathers_name', 'role', 'phone'], 'string', 'max' => 255],
            [['name', 'surname', 'fathers_name', 'role', 'username'], 'required'],

            [['pass'], 'string', 'min' => 5],

            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
        ];
    }


}

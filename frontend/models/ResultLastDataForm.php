<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

class ResultLastDataForm extends Model
{
    const HELP = 1;
    const STANDARD = 2;

    public $category;

    public $help_name;
    public $help_count;

    public $standard_name;
    public $standard_count;

    public function rules()
    {
        return
            [
                [['standard_count', 'help_count', 'category'], 'integer'],
                [['standard_name', 'help_name'], 'string']
            ];
    }

    public static function categoryList()
    {
        return [
            self::HELP => 'Me\'yoriy hujjat bilan ta\'minlash yuzasidan amaliy yordam',
            self::STANDARD => 'Xalqaro standartlarni joriy etish',
        ];
    }

    public function attributeLabels()
    {
        return [
            'category' => 'Kategoriya',

            'help_count' => 'Me\'yoriy hujjat bilan ta\'minlash yuzasidan amaliy yordam soni',
            'help_name' => 'Me\'yoriy hujjat bilan ta\'minlash yuzasidan amaliy yordam nomi',
            'standard_count' => 'Xalqaro standartlarni joriy etish soni',
            'standard_name' => 'Xalqaro standartlarni joriy etish nomi',
        ];
    }
}

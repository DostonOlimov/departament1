<?php

namespace frontend\models;

use common\models\control\ProductType;
use common\models\ProgramType;
use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;

class PrimaryDataForm extends Model
{
    const CATEGORY_OV = 1;
    const CATEGORY_PRODUCT = 2;

    public $id;
    public $category;

    public $type;
    public $measurement;
    public $compared;
    public $invalid;

    public $product_type_id;
    public $nd;
    public $nd_type;
    public $number_blank;
    public $number_reestr;
    public $date_from;
    public $date_to;
    public $product_name;

    public function rules()
    {
        return [
//            [['type', 'measurement', 'compared', 'invalid'], 'required'],

            [['type', 'measurement', 'compared', 'invalid'], 'required', 'when' => function ($model) {
                return $model->category == self::CATEGORY_OV;
            }, 'whenClient' => "function (attribute, value) {
                return $('#category').val() == 1;
            }"],
            [['type', 'category'], 'integer'],
            [['nd'], 'safe'],
            [['measurement', 'compared', 'invalid', 'number_blank', 'number_reestr', 'date_from', 'date_to', 'product_name'], 'string'],
            [['product_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductType::className(), 'targetAttribute' => ['product_type_id' => 'id']],

        ];
    }

    public static function categoryList()
    {
        return [
            self::CATEGORY_OV => 'O\'lchov vositalari',
            self::CATEGORY_PRODUCT => 'Mahsulot',
        ];
    }

    public function attributeLabels()
    {
        return [
            'category' => '',

            'type' => 'O\'lchov vositasi turi (O\'.V)',
            'measurement' => 'O\'.V soni',
            'compared' => 'Qiyoslangan O\'.V soni',
            'invalid' => 'Yaroqsiz O\'.V soni',

            'product_type_id' => 'Mahsulot turi',
            'nd' => 'Mahsulot normativ hujjatlari',
            'nd_type' => 'Normativ hujjat toifalari',
            'number_blank' => 'Blank raqami',
            'number_reestr' => 'Reesstr raqami',
            'date_from' => 'Berilgan sana',
            'date_to' => 'Amal qilish muddati',
            'product_name' => 'Mahsulot nomi',
        ];
    }
}

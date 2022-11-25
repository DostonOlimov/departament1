<?php

namespace common\models\profilactic;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "pro_answer_standard_counts".
 *
 * @property int $id
 * @property int $pro_answer_id
 * @property string $name
 * @property int $type
 *
 * @property Answer $proAnswer
 */
class StandardZeroForm extends Model
{
    public $name;
    public $type;
    public $pro_answer_id;

    public function rules()
    {
        return [
            [['type'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pro_answer_id' => 'Pro Answer ID',
            'name' => 'Name',
            'type' => 'Type',
        ];
    }
}

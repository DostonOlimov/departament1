<?php

namespace common\models\profilactic;

use Yii;
use yii\db\ActiveRecord;

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
class AnswerStandardCount extends ActiveRecord
{
    //    public $comment;
    const TYPE_EIGHTY = 80;
    const TYPE_NINETY = 90;
    const TYPE_ZERO = 0;

    public static function tableName()
    {
        return 'pro_answer_standard_counts';
    }

    public function rules()
    {
        return [
            //[['pro_answer_id', 'name', 'type'], 'required'],
            [['pro_answer_id', 'type', 'name', 'category'], 'integer'],
            [['pro_answer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Answer::className(), 'targetAttribute' => ['pro_answer_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pro_answer_id' => 'Pro Answer ID',
            'name' => 'Soni',
            'category' => 'Toifa',
            'type' => 'Turi',
        ];
    }

    public static function categoryList()
    {
        return [
            0 => "xalqaro (davlatlararo, mintaqaviy) standartlar",
            1 => "O‘zbekiston Respublikasining davlat standartlari",
            2 => "tashkilotning standartlari",
            3 => "xorijiy mamlakatlarning milliy standartlari",
            4 => "Texnik reglamentlar",
            5 => "Va boshqalar...",
        ];
    }

    public static function typeList($type = null)
    {
        $arr = [
            self::TYPE_EIGHTY => '1980 - 1990 y.',
            self::TYPE_NINETY => '1990 - 2000 y.',
            self::TYPE_ZERO => '2000 - ' . date('Y') . ' y.',
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }

    public function getProAnswer()
    {
        return $this->hasOne(Answer::className(), ['id' => 'pro_answer_id']);
    }
}

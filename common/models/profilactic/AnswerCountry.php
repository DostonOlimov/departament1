<?php

namespace common\models\profilactic;

use common\models\Countries;
use Yii;

/**
 * This is the model class for table "pro_answer_countries".
 *
 * @property int $id
 * @property int $country_id
 * @property int $pro_answer_id
 *
 * @property Countries $country
 * @property Answer $proAnswer
 */
class AnswerCountry extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'pro_answer_countries';
    }

    public function rules()
    {
        return [
            [['country_id', 'pro_answer_id'], 'required'],
            [['country_id', 'pro_answer_id'], 'integer'],
            [['import_export'], 'string', 'max' => 255],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['pro_answer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Answer::className(), 'targetAttribute' => ['pro_answer_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_id' => 'Nomi',
            'pro_answer_id' => 'Pro Answer ID',
            'import_export' => 'Import yoki Eksport',
        ];
    }

    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
    }

    public function getProAnswer()
    {
        return $this->hasOne(Answer::className(), ['id' => 'pro_answer_id']);
    }
}

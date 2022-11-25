<?php

namespace common\models\profilactic;

use common\models\Countries;
use Yii;

/**
 * This is the model class for table "pro_results_countries".
 *
 * @property int $id
 * @property int|null $pro_result_id
 * @property int|null $country_id
 *
 * @property Countries $country
 * @property Result $proResult
 */
class ResultCountry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pro_results_countries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pro_result_id', 'country_id'], 'integer'],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['pro_result_id'], 'exist', 'skipOnError' => true, 'targetClass' => Result::className(), 'targetAttribute' => ['pro_result_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pro_result_id' => 'Pro Result ID',
            'country_id' => 'Country ID',
        ];
    }

    /**
     * Gets query for [[Country]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
    }

    /**
     * Gets query for [[ProResult]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProResult()
    {
        return $this->hasOne(Result::className(), ['id' => 'pro_result_id']);
    }
}

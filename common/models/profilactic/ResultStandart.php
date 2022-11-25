<?php

namespace common\models\profilactic;

use common\models\Nd;
use Yii;

/**
 * This is the model class for table "pro_result_standarts".
 *
 * @property int $id
 * @property int|null $pro_result_id
 * @property int|null $nd_id
 * @property string|null $standard_name
 *
 * @property Nd $nd
 * @property Result $proResult
 */
class ResultStandart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pro_result_standarts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pro_result_id', 'nd_id'], 'integer'],
            [['standard_name'], 'string', 'max' => 255],
            [['nd_id'], 'exist', 'skipOnError' => true, 'targetClass' => Nd::className(), 'targetAttribute' => ['nd_id' => 'id']],
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
            'nd_id' => 'Xalqaro standartlarni joriy etish soni',
            'standard_name' => 'Xalqaro standartlarni joriy etish nomi',
        ];
    }

    /**
     * Gets query for [[Nd]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNd()
    {
        return $this->hasOne(Nd::className(), ['id' => 'nd_id']);
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

<?php

namespace common\models\profilactic;

use common\models\Nd;
use Yii;

/**
 * This is the model class for table "result_nds".
 *
 * @property int $id
 * @property int|null $result_id
 * @property int|null $nd_id
 * @property string|null $description
 *
 * @property Nd $nd
 * @property Result $result
 */
class ResultNd extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'result_nds';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['result_id', 'nd_id'], 'integer'],
            [['description'], 'string', 'max' => 255],
            [['nd_id'], 'exist', 'skipOnError' => true, 'targetClass' => Nd::className(), 'targetAttribute' => ['nd_id' => 'id']],
            [['result_id'], 'exist', 'skipOnError' => true, 'targetClass' => Result::className(), 'targetAttribute' => ['result_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'result_id' => 'Result ID',
            'nd_id' => 'Nd ID',
            'description' => 'Description',
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
     * Gets query for [[Result]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResult()
    {
        return $this->hasOne(Result::className(), ['id' => 'result_id']);
    }
}

<?php

namespace common\models\profilactic;

use common\models\Nd;

/**
 * This is the model class for table "result_old_nds".
 *
 * @property int $id
 * @property int|null $nd_id
 * @property int|null $result_nd_id
 * @property string|null $description
 *
 * @property Nd $nd
 * @property ResultNd $resultNd
 */
class ResultOldNd extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'result_old_nds';
    }

    public function rules()
    {
        return [
            [['nd_id', 'result_nd_id'], 'integer'],
            [['description'], 'string', 'max' => 255],
            [['nd_id'], 'exist', 'skipOnError' => true, 'targetClass' => Nd::className(), 'targetAttribute' => ['nd_id' => 'id']],
            [['result_nd_id'], 'exist', 'skipOnError' => true, 'targetClass' => ResultNd::className(), 'targetAttribute' => ['result_nd_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nd_id' => 'Nd ID',
            'result_nd_id' => 'Old Nd ID',
            'description' => 'Description',
        ];
    }

    public function getNd()
    {
        return $this->hasOne(Nd::className(), ['id' => 'nd_id']);
    }

    public function getResultNd()
    {
        return $this->hasOne(ResultNd::className(), ['id' => 'result_nd_id']);
    }
}

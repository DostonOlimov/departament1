<?php

namespace common\models\control;

use Yii;

/**
 * This is the model class for table "control_primary_ovs".
 *
 * @property int $id
 * @property int $control_primary_data_id
 * @property int $type
 * @property string $measurement
 * @property string $compared
 * @property string $invalid
 *
 * @property PrimaryData $controlPrimaryData
 */
class PrimaryOv extends \yii\db\ActiveRecord
{
    const TYPE_ENER = 1;
    const TYPE_PRODUCT = 2;
    const TYPE_TEX = 3;

    public static function tableName()
    {
        return 'control_primary_ovs';
    }

    public function rules()
    {
        return [
            [['control_primary_data_id', 'type', 'measurement', 'compared', 'invalid'], 'required'],
            [['control_primary_data_id', 'type'], 'integer'],
            [['measurement', 'compared', 'invalid'], 'string', 'max' => 255],
            [['control_primary_data_id'], 'exist', 'skipOnError' => true, 'targetClass' => PrimaryData::className(), 'targetAttribute' => ['control_primary_data_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'control_primary_data_id' => 'Control Primary Data ID',
            'type' => 'O\'v turlari',
            'measurement' => 'O\'v soni',
            'compared' => 'Qiyoslangan o\'v soni',
            'invalid' => 'Yaroqsiz o\'v soni',
        ];
    }

    public static function getType($type = null)
    {
        $arr = [
            self::TYPE_ENER => 'Energiya resurslarini hisoblovchi',
            self::TYPE_PRODUCT => 'Mahsulot sifatini nazorat qiluvchi',
            self::TYPE_TEX => 'Texnolagik jarayonda ishlatiladigan',
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }

    /**
     * Gets query for [[ControlPrimaryData]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrimaryData()
    {
        return $this->hasOne(PrimaryData::className(), ['id' => 'control_primary_data_id']);
    }
}

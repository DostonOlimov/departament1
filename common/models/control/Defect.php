<?php

namespace common\models\control;

use common\models\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "control_defects".
 *
 * @property int $id
 * @property int $control_company_id
 * @property string|null $type
 * @property string|null $description
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Company $controlCompany
 * @property User $createdBy
 * @property User $updatedBy
 */
class Defect extends \yii\db\ActiveRecord
{
    const TYPE_TEX = 1;
    const TYPE_CER = 2;
    const TYPE_MET = 3;
    const TYPE_NO_DEFECT = 4;

    public static function tableName()
    {
        return 'control_defects';
    }

    public function rules()
    {
        return [
            [['control_company_id', 'type', 'description'], 'required'],
            [['control_company_id'], 'integer'],
            [['type'], 'safe'],
            [['description', 'compliance_quantity', 'compliance_cost', 'tex_quantity', 'tex_cost'], 'string'],
            [['control_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['control_company_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'control_company_id' => 'Control Company ID',
            'type' => 'Kamchiliklar',
            'compliance_quantity' => 'Muvofiqlik sertifikatsiz realizatsiya qilingan mahsulotlar miqdori',
            'compliance_cost' => 'Muvofiqlik sertifikatsiz realizatsiya qilingan mahsulotlar summasi',
            'tex_cost' => 'Amaldagi texnik reglament va normativ hujjatlar talablariga nomuvofiq mahsulotlar miqdori',
            'tex_quantity' => 'Amaldagi texnik reglament va normativ hujjatlar talablariga nomuvofiq mahsulotlar summasi',
            'description' => 'Izoh',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function typeList($type = null)
    {
        $arr = [
            self::TYPE_TEX => 'Texreglament va standartlar talablari buzilishi',
            self::TYPE_CER => 'Sertifikastsiya talablari buzilishi ',
            self::TYPE_MET => 'Metrologiya talablari buzilishi',
            self::TYPE_NO_DEFECT => 'Kamchiliklar aniqlanmadi',
        ];

        if ($type === null) {
            return $arr;
        }

        return $arr[$type];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
        ];
    }

    public function getControlCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'control_company_id']);
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}

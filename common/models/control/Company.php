<?php

namespace common\models\control;

use common\models\Region;
use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "control_companies".
 *
 * @property int $id
 * @property int $control_instruction_id
 * @property int|null $region_id
 * @property string|null $name
 * @property int|null $inn
 * @property int|null $soogu
 * @property string|null $type
 * @property int|null $phone
 * @property string|null $link
 * @property string|null $address
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Instruction $controlInstruction
 * @property User $createdBy
 * @property Region $region
 * @property User $updatedBy
 * @property PrimaryData $primaryData
 * @property Identification $identification
 * @property Laboratory $laboratory
 * @property Defect $defect
 * @property Caution $caution
 * @property Measure $measure
 * @property $phoneNumber
 */
class Company extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'control_companies';
    }

    public function rules()
    {
        return [
            [['control_instruction_id', 'region_id', 'inn', 'soogu', 'phone', 'name', 'type', 'address'], 'required'],
            [['control_instruction_id', 'region_id', 'inn', 'soogu'], 'integer'],
            [['name', 'type', 'link', 'address', 'phone'], 'string', 'max' => 255],
            [['control_instruction_id'], 'exist', 'skipOnError' => true, 'targetClass' => Instruction::className(), 'targetAttribute' => ['control_instruction_id' => 'id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'control_instruction_id' => 'Control Instruction ID',
            'region_id' => 'Hudud',
            'name' => 'XYUS nomi',
            'inn' => 'XYUS inn',
            'soogu' => 'Kod SOOGU',
            'type' => 'XYUS faoliyat turi',
            'phone' => 'XYUS tel',
            'link' => 'XYUS manziliga havola',
            'address' => 'XYUS yuridik manzil',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getPhoneNumber()
    {
        return '(' . substr($this->phone,0, 2) . ')-' . substr($this->phone,2,3) . '-' .
            substr($this->phone,5,2) . '-' . substr($this->phone,7,2);
    }

    public function trimPhoneNumber()
    {
        $this->phone = substr(preg_replace('#[^0-9]#', '', $this->phone),-9);
    }

    public function beforeSave($insert)
    {
        if ($this->phone) {
            $this->trimPhoneNumber();
        }

        return parent::beforeSave($insert);
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
        ];
    }

    public function getControlInstruction()
    {
        return $this->hasOne(Instruction::className(), ['id' => 'control_instruction_id']);
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    public function getPrimaryData()
    {
        return $this->hasOne(PrimaryData::className(), ['control_company_id' => 'id']);
    }

    public function getCaution()
    {
        return $this->hasOne(Caution::className(), ['control_company_id' => 'id']);
    }

    public function getIdentification()
    {
        return $this->hasOne(Identification::className(), ['control_company_id' => 'id']);
    }

    public function getLaboratory()
    {
        return $this->hasOne(Laboratory::className(), ['control_company_id' => 'id']);
    }

    public function getDefect()
    {
        return $this->hasOne(Defect::className(), ['control_company_id' => 'id']);
    }

    public function getMeasure()
    {
        return $this->hasOne(Measure::className(), ['control_company_id' => 'id']);
    }
}

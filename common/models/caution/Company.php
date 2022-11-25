<?php

namespace common\models\caution;

use common\models\Region;
use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "caution_companies".
 *
 * @property int $id
 * @property int $caution_instruction_id
 * @property string|null $name
 * @property int|null $inn
 * @property string|null $type
 * @property int|null $phone
 * @property string|null $link
 * @property string|null $address
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Instruction $cautionInstruction
 * @property Execution $execution
 * @property Region $region
 * @property User $createdBy
 * @property User $updatedBy
 */
class Company extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'caution_companies';
    }

    public function rules()
    {
        return [
            [['caution_instruction_id', 'region_id'], 'required'],
            [['caution_instruction_id', 'inn', 'region_id'], 'integer'],
            [['name', 'type', 'link', 'phone', 'address'], 'string', 'max' => 255],
            [['caution_instruction_id'], 'exist', 'skipOnError' => true, 'targetClass' => Instruction::className(), 'targetAttribute' => ['caution_instruction_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'caution_instruction_id' => 'Caution Instruction ID',
            'region_id' => 'Hudud',
            'name' => 'XYUS nomi',
            'inn' => 'XYUS INN',
            'type' => 'Faoliyat turi',
            'phone' => 'XYUS tel',
            'link' => 'Link',
            'address' => 'XYUS yuridik manzili',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
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

    public function getCautionInstruction()
    {
        return $this->hasOne(Instruction::className(), ['id' => 'caution_instruction_id']);
    }

    public function getExecution()
    {
        return $this->hasOne(Execution::className(), ['caution_company_id' => 'id']);
    }

    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
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

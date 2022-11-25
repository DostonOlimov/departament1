<?php

namespace common\models\profilactic;

use common\models\Region;
use common\models\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "companies".
 *
 * @property int $id
 * @property string $name
 * @property int $inn
 * @property int $pro_instruction_id
 * @property string|null $type
 * @property string|null $link
 * @property int|null $phone
 * @property string|null $address
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pro_companies';
    }

    public function rules()
    {
        return [
            [['name', 'inn', 'address', 'pro_instruction_id', 'region_id'], 'required'],
            [['link'], 'url'],
            ['name', 'unique'],
            [['inn', 'pro_instruction_id', 'region_id'], 'integer'],
            [['pro_instruction_id'], 'exist', 'skipOnError' => true, 'targetClass' => Instruction::className(), 'targetAttribute' => ['pro_instruction_id' => 'id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'id']],
            [['name', 'phone', 'address'], 'string', 'max' => 255],
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


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'XYUS nomi',
            'inn' => 'XYUS STIR',
            // 'type' => 'XYUS faoliyat turi',
            'link' => 'XYUS manzil havolasi',
            'region_id' => 'Hudud',
            'pro_instruction_id' => 'Asos', 
            'phone' => 'XYUS telefon nomeri',
            'address' => 'XYUS yuridik manzili',

            'created_by' => 'Mutaxasis',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    public function getAnswer()
    {
        return $this->hasOne(Answer::className(), ['pro_company_id' => 'id']);
    }


    public function getProInstruction()
    {
        return $this->hasOne(Instruction::className(), ['id' => 'pro_instruction_id']);
    }
}

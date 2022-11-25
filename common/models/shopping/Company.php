<?php

namespace common\models\shopping;

use common\models\Region;
use common\models\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "shopping_companies".
 *
 * @property int $id
 * @property int $shopping_instruction_id
 * @property int|null $region_id
 * @property string $name
 * @property int $inn
 * @property string|null $after
 * @property int|null $phone
 * @property string|null $link
 * @property string|null $address
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property Region $region
 * @property Product $product
 * @property Instruction $shoppingInstruction
 * @property User $updatedBy
 */
class Company extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'shopping_companies';
    }

    public function rules()
    {
        return [
            [['shopping_instruction_id', 'name', 'inn', 'phone', 'address', 'after'], 'required'],
            [['shopping_instruction_id', 'region_id', 'inn'], 'integer'],
            [['name', 'after', 'link', 'address', 'phone'], 'string', 'max' => 255],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'id']],
            [['shopping_instruction_id'], 'exist', 'skipOnError' => true, 'targetClass' => Instruction::className(), 'targetAttribute' => ['shopping_instruction_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shopping_instruction_id' => 'Shopping Instruction ID',
            'region_id' => 'Hudud',
            'name' => 'XYUS nomi',
            'inn' => 'XYUS INN',
            'after' => 'XYUS Rahbari F.I.SH',
            'phone' => 'XYUS tel',
            'link' => 'Link',
            'address' => 'Nazorat xaridi tadbiri o\'tkazilayotgan joy',
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

    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['shopping_company_id' => 'id']);
    }

    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    public function getShoppingInstruction()
    {
        return $this->hasOne(Instruction::className(), ['id' => 'shopping_instruction_id']);
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}

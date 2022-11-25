<?php

namespace common\models\control;

use common\models\User;
use Yii;

/**
 * This is the model class for table "inspectors".
 *
 * @property int $id
 * @property int $user_id
 * @property int $instruction_id
 *
 * @property Instruction $instruction
 * @property User $user
 */
class InstructionUser extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'instruction_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'instruction_id'], 'required'],
            [['user_id', 'instruction_id'], 'integer'],
            [['instruction_id'], 'exist', 'skipOnError' => true, 'targetClass' => Instruction::className(), 'targetAttribute' => ['instruction_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'instruction_id' => 'Instruction ID',
        ];
    }

    /**
     * Gets query for [[Instruction]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInstruction()
    {
        return $this->hasOne(Instruction::className(), ['id' => 'instruction_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}

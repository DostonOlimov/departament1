<?php

namespace common\models\caution;

use Yii;

/**
 * This is the model class for table "caution_instructions".
 *
 * @property int $id
 * @property int|null $base
 * @property int|null $letter_date
 * @property string|null $letter_number
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property CautionCompanies[] $cautionCompanies
 * @property User $createdBy
 * @property User $updatedBy
 */
class CautionInstruction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'caution_instructions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['base', 'letter_date', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['created_by', 'updated_by', 'created_at', 'updated_at'], 'required'],
            [['letter_number'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'base' => 'Base',
            'letter_date' => 'Letter Date',
            'letter_number' => 'Letter Number',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[CautionCompanies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCautionCompanies()
    {
        return $this->hasMany(CautionCompanies::className(), ['caution_instruction_id' => 'id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}

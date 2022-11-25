<?php

namespace common\models\control;

use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "control_primary_data".
 *
 * @property int $id
 * @property int $control_company_id
 * @property string|null $residue_quantity
 * @property string|null $residue_amount
 * @property string|null $potency
 * @property string|null $year_quantity
 * @property string|null $year_amount
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Company $controlCompany
 * @property PrimaryProduct[] $controlPrimaryProducts
 * @property User $createdBy
 * @property User $updatedBy
 */
class PrimaryData extends \yii\db\ActiveRecord
{
    const LABORATORY_HAVE = 1;
    const LABORATORY_CONTRACT = 2;
    const LABORATORY_NOT = 3;

    public static function tableName()
    {
        return 'control_primary_data';
    }

    public function rules()
    {
        return [
            [['control_company_id', 'laboratory'], 'required'],
            [['control_company_id', 'laboratory', 'smt'], 'integer'],
            [['residue_quantity', 'residue_amount', 'potency', 'year_quantity', 'year_amount'], 'string', 'max' => 255],
            [['control_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['control_company_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'control_company_id' => 'Control Company ID',
//            'count' => 'O\'lchov vositasi soni',
//            'compared_count' => 'Qiyoslangan o\'lchov vositasi soni',
//            'invalid_count' => 'Yaroqsiz o\'lchov vositasi soni',
//            'certificate' => 'Muvofiq sertifikati (talab etilgan hollarda)',
            'residue_quantity' => 'Qoldiq miqdori',
            'residue_amount' => 'Qoldiq summasi',
            'potency' => 'Ishlab chiqarish quvvati',
            'year_quantity' => 'Ishlab chiqarilgan miqdori(12 oy mobaynida )',
            'year_amount' => 'Summasi(12 oy mobaynida)',
            'laboratory' => 'Sinov laboratoriyasining mavjudligi',
            'smt' => 'SMT joriy etilganligi',
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

    public static function getLab($lab = null)
    {
        $arr = [
            self::LABORATORY_HAVE => 'Sinov laboratoriyasi mavjud',
            self::LABORATORY_CONTRACT => 'Shartnoma asosida',
            self::LABORATORY_NOT => 'Sinov laboratoriyasidan foydalanilmaydi',
        ];

        if ($lab === null) {
            return $arr;
        }

        return $arr[$lab];
    }

    public function getControlCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'control_company_id']);
    }

    public function getControlPrimaryProducts()
    {
        return $this->hasMany(PrimaryProduct::className(), ['control_primary_data_id' => 'id']);
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

<?php

namespace common\models\profilactic;

use common\models\Nd;
use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "pro_results".
 *
 * @property int $id
 * @property int|null $pro_company_id
 * @property string|null $help_name
 * @property int|null $help_count
 * @property string|null $active_name
 * @property int|null $active_count
 * @property string|null $standard_name
 * @property int|null $standard_count
 * @property string|null $certificate_help
 * @property string|null $certificate_text
 * @property string|null $decision_text
 * @property string|null $import_export_text
 * @property string|null $measure_help_name
 * @property int|null $measure_help_count
 * @property int|null $import_export
 * @property string|null $smk
 * @property string|null $smk_text
 * @property string|null $decision
 * @property string|null $problem
 * @property string|null $people
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property Company $proCompany
 * @property User $updatedBy
 */
class Result extends \yii\db\ActiveRecord
{
    public $countries;

    public static function tableName()
    {
        return 'pro_results';
    }

    public function rules()
    {
        return [
            [['pro_company_id', 'active_count', 'measure_help_count'], 'integer'],
            [['import_export', 'smk', 'decision'], 'boolean'],
            [['active_name', 'certificate_help', 'measure_help_name', 'problem', 'people'], 'string', 'max' => 255],
            [['smk_text', 'certificate_text', 'decision_text', 'import_export_text'], 'string'],
            [['pro_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['pro_company_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pro_company_id' => 'Pro Company ID',

            'active_name' => 'Nomi',
            'active_count' => 'Soni',
            'certificate_help' => 'Sertifikatlashtirish yuzasidan amaliy yordam va ma\'lumoti',
            'certificate_text' => 'Sertifikat ma`lumoti',

            'measure_help_name' => 'O\'lchov vositalari bo\'yicha amaliy yordam nomi',
            'measure_help_count' => 'O\'lchov vositalari bo\'yicha amaliy yordam soni',
            'import_export' => 'Import/Export ga amaliy yordam',
            'decision' => 'Sohaga oid qonun va qarorlar bilan tanishtirish',
            'decision_text' => 'Sohaga oid qonun va qarorlar bilan tanishtirish ma`lumoti',
            'problem' => 'Korxonaning muammo va takliflari:',
            'people' => 'Profilaktika o\'tkazgan mutaxassis F.I.SH:',
            'import_export_text' => 'Import/Export ma`lumoti',
            'smk' => 'SMT joriy etilishida amaliy yordam',
            'smk_text' => 'SMT ma`lumoti',

            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
        ];
    }

    public function getProCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'pro_company_id']);
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

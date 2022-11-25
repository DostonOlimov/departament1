<?php

namespace common\models;

use common\models\profilactic\Company;
use Yii;

/**
 * This is the model class for table "disorders".
 *
 * @property int $id
 * @property string|null $standart
 * @property string|null $certificate
 * @property string|null $metrologic
 *
 * @property Company $company
 */
class Disorder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'disorders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'type'], 'integer'],
            [['standart', 'certificate', 'metrologic'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'standart' => 'Standartlashtirish sohasida',
            'certificate' => 'Sertifikatlashtirish sohasida',
            'metrologic' => 'Metrologiya sohasida',
	    'type' => 'Turi',
        ];
    }

    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }
}

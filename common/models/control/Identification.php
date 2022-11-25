<?php

namespace common\models\control;

use common\models\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * This is the model class for table "control_identifications".
 *
 * @property int $id
 * @property int $control_company_id
 * @property string|null $file
 * @property string|null $identification
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Company $controlCompany
 * @property User $createdBy
 * @property User $updatedBy
 */
class Identification extends \yii\db\ActiveRecord
{
    public $img;
    public static function tableName()
    {
        return 'control_identifications';
    }

    public function rules()
    {
        return [
//            [['identification'], 'required'],
            [['control_company_id'], 'integer'],
            [['file'], 'image'],
            [['identification'], 'string', 'max' => 255],
            [['control_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['control_company_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'control_company_id' => 'Control Company ID',
            'file' => 'Rasm',
            'identification' => 'Idintifikatsiya',
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
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'img',
                'createThumbsOnRequest' => true,
                'filePath' => '@frontend/web/app-images/store/control-identification/[[attribute_id]]/[[filename]].[[extension]]',
                'fileUrl' => '@url/app-images/store/control-identification/[[attribute_id]]/[[filename]].[[extension]]',
                'thumbPath' => '@frontend/web/app-images/cache/control-identification/[[attribute_id]]/[[profile]]_[[filename]].[[extension]]',
                'thumbUrl' => '@url/app-images/cache/control-identification/[[attribute_id]]/[[profile]]_[[filename]].[[extension]]',
                'thumbs' => [
                    'xs' => ['width' => 64, 'height' => 48],
                    'sm' => ['width' => 120, 'height' => 67],
                    'md' => ['width' => 240, 'height' => 135],
                    'lg' => ['width' => 960, 'height' => 540],
                ],
            ],
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'file',
                'createThumbsOnRequest' => true,
                'filePath' => '@frontend/web/app-images/store/control-identification/[[attribute_id]]/[[filename]].[[extension]]',
                'fileUrl' => '@url/app-images/store/control-identification/[[attribute_id]]/[[filename]].[[extension]]',
                'thumbPath' => '@frontend/web/app-images/cache/control-identification/[[attribute_id]]/[[profile]]_[[filename]].[[extension]]',
                'thumbUrl' => '@url/app-images/cache/control-identification/[[attribute_id]]/[[profile]]_[[filename]].[[extension]]',
                'thumbs' => [
                    'xs' => ['width' => 64, 'height' => 48],
                    'sm' => ['width' => 120, 'height' => 67],
                    'md' => ['width' => 240, 'height' => 135],
                    'lg' => ['width' => 960, 'height' => 540],
                ],
            ],
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

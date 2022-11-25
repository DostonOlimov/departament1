<?php

namespace common\models\shopping;

use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * This is the model class for table "shopping_products".
 *
 * @property int $id
 * @property int $shopping_company_id
 * @property string|null $name
 * @property int|null $quantity
 * @property int|null $cost
 * @property string|null $photo
 * @property string|null $photo_chek
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property Company $shoppingCompany
 * @property User $updatedBy
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shopping_products';
    }

    public function rules()
    {
        return [
            [['shopping_company_id'], 'required'],
            [['shopping_company_id', 'quantity', 'cost'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['photo', 'photo_chek'], 'image'],
            [['shopping_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['shopping_company_id' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'photo',
                'createThumbsOnRequest' => true,
                'filePath' => '@frontend/web/app-images/store/shopping-product/[[attribute_id]]/[[filename]].[[extension]]',
                'fileUrl' => '@url/app-images/store/shopping-product/[[attribute_id]]/[[filename]].[[extension]]',
                'thumbPath' => '@frontend/web/app-images/cache/shopping-product/[[attribute_id]]/[[profile]]_[[filename]].[[extension]]',
                'thumbUrl' => '@url/app-images/cache/shopping-product/[[attribute_id]]/[[profile]]_[[filename]].[[extension]]',
                'thumbs' => [
                    'xs' => ['width' => 64, 'height' => 48],
                    'sm' => ['width' => 120, 'height' => 67],
                    'md' => ['width' => 240, 'height' => 135],
                    'lg' => ['width' => 960, 'height' => 540],
                ],
            ],
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'photo_chek',
                'createThumbsOnRequest' => true,
                'filePath' => '@frontend/web/app-images/store/shopping-product/[[attribute_id]]/[[filename]].[[extension]]',
                'fileUrl' => '@url/app-images/store/shopping-product/[[attribute_id]]/[[filename]].[[extension]]',
                'thumbPath' => '@frontend/web/app-images/cache/shopping-product/[[attribute_id]]/[[profile]]_[[filename]].[[extension]]',
                'thumbUrl' => '@url/app-images/cache/shopping-product/[[attribute_id]]/[[profile]]_[[filename]].[[extension]]',
                'thumbs' => [
                    'xs' => ['width' => 64, 'height' => 48],
                    'sm' => ['width' => 120, 'height' => 67],
                    'md' => ['width' => 240, 'height' => 135],
                    'lg' => ['width' => 960, 'height' => 540],
                ],
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shopping_company_id' => 'Shopping Company ID',
            'name' => 'Maxsulot nomi',
            'quantity' => 'Maxsulot miqdori',
            'cost' => 'Na`muna narxi',
            'photo' => 'Mahsulot rasmi',
            'photo_chek' => 'Chek rasmi',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getShoppingCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'shopping_company_id']);
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}

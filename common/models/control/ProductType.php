<?php

namespace common\models\control;

use Yii;

/**
 * This is the model class for table "product_types".
 *
 * @property int $id
 * @property string $name
 *
 * @property PrimaryProduct[] $controlPrimaryProducts
 */
class ProductType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nomi',
        ];
    }

    /**
     * Gets query for [[ControlPrimaryProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getControlPrimaryProducts()
    {
        return $this->hasMany(PrimaryProduct::className(), ['product_type_id' => 'id']);
    }
}

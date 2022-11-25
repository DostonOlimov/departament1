<?php

namespace common\models\profilactic;

use common\models\control\ProductType;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use common\models\User;

/**
 * This is the model class for table "pro_answers".
 *
 * @property int $id
 * @property int $pro_company_id
 * @property string|null $product_name
 * @property string|null $internation_standard
 * @property string|null $product_quality
 * @property string|null $import_export_product
 * @property string|null $employee
 * @property string|null $smk
 * @property string|null $international_certificate
 * @property int|null $import_export
 * @property int|null $lab_check
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property Company $proCompany
 * @property ProductType $productType
 * @property User $updatedBy
 */
class Answer extends ActiveRecord
{
    public $import;
    public $export;

    const LAB_AVAILABLE = 1;
    const LAB_CONTRACT = 2;
    const LAB_ABSENT = 3;

    public static function tableName()
    {
        return 'pro_answers';
    }

    public function rules()
    {
        return [
            [['pro_company_id'], 'required'],
            [['pro_company_id', 'reestr_number', 'all_instruments', 'expired_instruments', 'not_expired_instruments'], 'integer'],
            [['import', 'export'], 'safe'],
            [['product_name', 'internation_standard', 'product_quality', 'employee', 'smk', 'international_certificate', 'product_type_id', 'organization_name', 'lab_check'], 'string', 'max' => 255],
            [[ 'validity_period', 'overall_comment'], 'string', 'max' => 500],
            [[ 'import_product' , 'export_product'], 'string', 'max' => 100],
            [['pro_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['pro_company_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pro_company_id' => 'Pro Company ID',
            'product_type_id' => 'Soha nomi',
            'product_name' => 'Ishlab chiqariladigan mahsulotlari nomi',
            'internation_standard' => 'Xalqaro standartlarning joriy etilganligi',
            'employee' => 'Korxona hodimlarining malakasi oshiriliganligi',
            'smk' => 'SMT mavjudligi',
            'international_certificate' => 'Xalqaro sertifikatning mavjudligi',
            'organization_name' => 'Sertifikatlashtirish organ nomi',
            'reestr_number' => 'Reestr raqami',
            'validity_period' => 'Amal qilish muddati',
            'lab_check' => 'Sinov labaratoriyasining mavjudliligi:',

            'import_product' => 'Import mahsulotlari nomi',
            'export_product' => 'Export mahsulotlari nomi',
            'overall_comment' => 'Yuqoridagi ma\'lumotlar keltirilmaganda:',
            'product_quality' => 'Mahsulot sifati (Orgonoleptika)',
            'all_instruments' => 'Jami o\'lchov vositalari soni',
            'expired_instruments' => 'Qiyoslash muddati o\'tgan o\'lchov vositalari soni' ,
            'not_expired_instruments' => 'Qiyoslovdan o\'tmagan  vositalari soni' ,
           
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

    public static function labList($lab = null)
    {
        $arr = [
            self::LAB_AVAILABLE => 'Sinov labaratoriyasi mavjud',
            self::LAB_CONTRACT => 'Shartnoma asosida',
            self::LAB_ABSENT => 'Sinov labaratoriyasidan foydalanilmaydi',
        ];

        if ($lab === null) {
            return $arr;
        }

        return $arr[$lab];
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getProCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'pro_company_id']);
    }


    public function getProductType(){
        return $this->hasOne(ProductType::className(), ['id' => 'product_type_id']);
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}

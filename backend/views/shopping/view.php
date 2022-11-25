<?php

use common\models\shopping\Company;
use common\models\shopping\Instruction;
use common\models\shopping\Product;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\profilactic\Instruction */

$this->title = 'Profilaktika uchun asos';
$this->params['breadcrumbs'][] = ['label' => 'Korxonalar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
    <div class="instruction-view">

        <p>
            <?= Html::a('Yangilash', ['/shopping/instruction/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Hamma ma`lumotni o\'chirish', ['/shopping/instruction/delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Haqiqatan ham bu elementni o‘chirmoqchimisiz?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
//            'id',
                [
                    'attribute' => 'base',
                    'value' => function ($model) {
                        return Instruction::getType($model->base);
                    }
                ],
                'letter_date:date',
                'letter_number',
//            'product',
//            'phone',
//            'address',
//            'created_by',
//            'updated_by',
//            'created_at',
//            'updated_at',
            ],
        ]) ?>

    </div>


<?php
$company = Company::findOne(['shopping_instruction_id' => $model->id]);
if ($company) { ?>
    <hr>
    <h2>Xyus to'g'risida ma`lumot</h2>
    <div class="company-view">
        <p>
            <?= Html::a('Yangilash', ['/shopping/company/update', 'id' => $company->id], ['class' => 'btn btn-primary']) ?>
        </p>
        <?= DetailView::widget([
            'model' => $company,
            'attributes' => [
                'name',
                'inn',
                [
                    'attribute' => 'phone',
                    'value' => function (Company $model) {
                        return $model->phoneNumber;
                    },
                ],
                [
                    'label' => 'Hudud',
                    'value' => function (Company $model) {
                        return $model->region->name;
                    }
                ],
                'after',
                'address',
                [
                    'label' => 'Mutaxasis',
                    'value' => function (Company $model) {
                        return $model->createdBy->username;
                    },
                ],
            ],
        ]) ?>
    </div>

    <?php
    $answer = Product::findOne(['shopping_company_id' => $company->id]);
    if ($answer) { ?>
        <hr>
        <h2>Mahsulot to'g'risida ma`lumot</h2>
        <div class="company-view">
            <p>
                <?= Html::a('Yangilash', ['/shopping/product/update', 'id' => $answer->id], ['class' => 'btn btn-primary']) ?>
            </p>
            <?= DetailView::widget([
                'model' => $answer,
                'attributes' => [
//                    'id',
//                    'pro_company_id',

                    'name',
                    'quantity',
                    'cost',
                    [
                        'attribute' => 'photo',
                        'value' => function (Product $model) {
                            return '<img src="' . $model->getThumbFileUrl('photo', 'sm') . '" >';
                        },
                        'format' => 'raw'
                    ],
                    [
                        'attribute' => 'photo_chek',
                        'value' => function (Product $model) {
                            return '<img src="' . $model->getThumbFileUrl('photo', 'sm') . '" >';
                        },
                        'format' => 'raw'
                    ],
                ],
            ]) ?>
        </div>
    <?php }
} ?>
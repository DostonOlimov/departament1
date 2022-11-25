<?php

/* @var $this yii\web\View */
/* @var $model Product */

use common\models\shopping\Product;
use frontend\widgets\StepsShopping;
use yii\widgets\DetailView;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="page1-1 row ">

    <?= StepsShopping::widget([
        'shopping_instruction_id' => $model->shoppingCompany->shopping_instruction_id,
        'shopping_company_id' => $model->shopping_company_id,
    ]) ?>

    <div class="col-6">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
//            'id',
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
//            'created_by',
//            'updated_by',
//            'created_at',
//            'updated_at',
            ],
        ]) ?>
    </div>

</div>

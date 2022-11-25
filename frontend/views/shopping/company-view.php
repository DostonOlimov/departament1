<?php

/* @var $this yii\web\View */
/* @var $model Company */

use common\models\shopping\Company;
use frontend\widgets\StepsShopping;
use yii\widgets\DetailView;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="page1-1 row ">

    <?= StepsShopping::widget([
        'shopping_instruction_id' => $model->shopping_instruction_id,
        'shopping_company_id' => $model->id,
    ]) ?>

    <div class="col-6">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
//            'id',
                [
                    'attribute' => 'region_id',
                    'value' => function (Company $model) {
                        return $model->region->name;
                    }
                ],
                'name',
                'inn',
                [
                    'attribute' => 'phone',
                    'value' => function (Company $model) {
                        return $model->phoneNumber;
                    },
                ],
                'after',
                'address',
//            'created_by',
//            'updated_by',
//            'created_at',
//            'updated_at',
            ],
        ]) ?>
    </div>

</div>

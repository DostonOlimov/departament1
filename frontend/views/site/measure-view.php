<?php

/* @var $this yii\web\View */
/* @var $model ControlMeasure */

use common\models\ControlMeasure;
use frontend\widgets\Steps;
use yii\widgets\DetailView;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;

if ($model->type == ControlMeasure::TYPE_ADMINISTRATIVE) {
    $attr = [
//            'id',
        [
            'attribute' => 'type',
            'value' => function (ControlMeasure $model) {
                return '<label>' . ControlMeasure::typeList($model->type) . '</label><br>';
            },
            'format' => 'raw'
        ],
        'person',
        'number_passport',
        'fine_amount',
    ];
} else {
    $attr = [
//            'id',
        [
            'attribute' => 'type',
            'value' => function (ControlMeasure $model) {
                return '<label>' . ControlMeasure::typeList($model->type) . '</label><br>';
            },
            'format' => 'raw'
        ],
        'date:date',
        'quantity',
        'amount',
    ];
}

?>


<div class="page1-1 row ">

    <?= Steps::widget([
        'control_instruction_id' => $model->controlCompany->control_instruction_id,
        'control_company_id' => $model->control_company_id,
    ]) ?>

    <div class="col-6">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => $attr,
        ]) ?>
    </div>

</div>

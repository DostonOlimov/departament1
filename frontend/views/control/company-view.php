<?php

/* @var $this yii\web\View */
/* @var $model Company */

use common\models\control\Company;
use frontend\widgets\Steps;
use yii\widgets\DetailView;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="page1-1 row ">

    <?= Steps::widget([
        'control_instruction_id' => $model->control_instruction_id,
        'control_company_id' => $model->id,
    ]) ?>

    <div class="col-6">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
//            'id',
                'name',
                'inn',
                'soogu',
                'address',
                'type',
                [
                    'attribute' => 'phone',
                    'value' => function (Company $model) {
                        return $model->phoneNumber;
                    },
                ],
                [
                    'attribute' => 'region_id',
                    'value' => function (Company $model) {
                        return $model->region->name;
                    },
                ],
            ],
        ]) ?>
    </div>

</div>

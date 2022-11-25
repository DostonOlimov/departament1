<?php

/* @var $this yii\web\View */
/* @var $model Company */

use common\models\caution\Company;
use frontend\widgets\StepsCautions;
use yii\widgets\DetailView;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="page1-1 row ">

    <?= StepsCautions::widget([
        'caution_instruction_id' => $model->caution_instruction_id,
        'caution_company_id' => $model->id,
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
                [
                    'attribute' => 'XYUS tel',
                    'value' => function (Company $model) {
                        return $model->phoneNumber;
                    }
                ],
                'name',
                'inn',
                'type',
                'address',
//            'created_by',
//            'updated_by',
//            'created_at',
//            'updated_at',
            ],
        ]) ?>
    </div>

</div>

<?php

/* @var $this yii\web\View */
/* @var $model ControlInstruction */

use common\models\ControlCompany;
use common\models\ControlInstruction;
use frontend\widgets\Steps;
use yii\widgets\DetailView;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;

$company = ControlCompany::findOne(['control_instruction_id' => $model->id])
?>


<div class="page1-1 row ">

    <?= Steps::widget([
        'control_instruction_id' => $model->id,
        'control_company_id' => $company ? $company->id : null,
    ]) ?>

    <div class="col-6">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
//            'id',
                [
                    'attribute' => 'base',
                    'value' => function ($model) {
                        return ControlInstruction::getType($model->base);
                    }
                ],
                'letter_date:date',
                'letter_number',
                'command_date:date',
                'command_number',
//            'created_by',
//            'updated_by',
//            'created_at',
//            'updated_at',
            ],
        ]) ?>
    </div>

</div>

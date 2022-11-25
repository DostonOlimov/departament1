<?php

/* @var $this yii\web\View */
/* @var $model Instruction */

use common\models\caution\Company;
use common\models\caution\Instruction;
use frontend\widgets\StepsCautions;
use yii\widgets\DetailView;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;

$company = Company::findOne(['caution_instruction_id' => $model->id])
?>


<div class="page1-1 row ">

    <?= StepsCautions::widget([
        'caution_instruction_id' => $model->id,
        'caution_company_id' => $company ? $company->id : null,
    ]) ?>

    <div class="col-6">
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
//            'created_by',
//            'updated_by',
//            'created_at',
//            'updated_at',
            ],
        ]) ?>
    </div>

</div>

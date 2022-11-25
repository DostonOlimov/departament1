<?php

/* @var $this yii\web\View */

/* @var $model Instruction */

use common\models\profilactic\Company;
use common\models\profilactic\Instruction;
use frontend\widgets\StepsProfilactic;
use yii\widgets\DetailView;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;

$proCompany = Company::findOne(['pro_instruction_id' => $model->id])
?>


<div class="page1-1 row ">

    <?= StepsProfilactic::widget([
        'pro_instruction_id' => $model->id,
        'pro_company_id' => $proCompany ? $proCompany->id : null,
    ]) ?>

    <div class="col-6">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'attribute' => 'base',
                    'value' => function ($model) {
                        return ($model->base || $model->base === 0) ? Instruction::getType($model->base) : '';
                    }
                ],
                [
                    'attribute' => 'subject',
                    'value' => function ($model) {
                        return ($model->subject || $model->subject === 0) ? Instruction::getSubject($model->subject) : '';
                    }
                ],
                [
                    'attribute' => 'program_type',
                    'value' => function ($model) {
                        return array_key_exists($model->program_type, Instruction::getProgramType()) ? Instruction::getProgramType($model->program_type) : '';
                    }
                ],
                [
                    'attribute' => 'status',
                    'value' => function ($model) {
                        return ($model->status || $model->status === 0) ? Instruction::getStatus($model->status) : '';
                    }
                ],
                'letter_date',
		'fio',
                'letter_number',

//            'updated_by',
//            'created_at',
//            'updated_at',
            ],
        ]) ?>
    </div>

</div>

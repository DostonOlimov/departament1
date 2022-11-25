<?php

/* @var $this yii\web\View */
/* @var $model Instruction */

use common\models\shopping\Instruction;
use common\models\shopping\Company;
use frontend\widgets\StepsShopping;
use yii\widgets\DetailView;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;

$company = Company::findOne(['shopping_instruction_id' => $model->id])
?>


<div class="page1-1 row ">

    <?= StepsShopping::widget([
        'shopping_instruction_id' => $model->id,
        'shopping_company_id' => $company ? $company->id : null,
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

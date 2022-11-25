<?php

/* @var $this yii\web\View */
/* @var $model Execution */

use common\models\caution\Execution;
use frontend\widgets\StepsCautions;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="page1-1 row ">
    <?= StepsCautions::widget([
        'caution_instruction_id' => $model->cautionCompany->caution_instruction_id,
        'caution_company_id' => $model->caution_company_id,
    ]) ?>

    <?php $form = ActiveForm::begin() ?>

    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'date')->widget(DatePicker::className()) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'number')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'description')->textarea() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'deficiency')->checkbox() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <input type="submit" class="btn btn-info br-btn" value="Saqlash">
        </div>
    </div>

    <?php ActiveForm::end() ?>

</div>


<!--<a class="btn-primary btn-lg otishIcon" href="#" role="button">Xavfli maxsulotlar resstriga o'tish <i class="fas fa-chevron-circle-right icon4 fa-1x "></i></a>-->

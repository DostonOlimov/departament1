<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model Laboratory */


use common\models\control\Laboratory;
use frontend\widgets\Steps;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;

$this->title = 'Na`muna olish va labaratoriya natijalari';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page1-1 row">

    <?= Steps::widget([
        'control_instruction_id' => $model->controlCompany->controlInstruction->id,
        'control_company_id' => $model->control_company_id,
    ]) ?>

    <?php $form = ActiveForm::begin() ?>

    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'dalolatnoma')->fileInput() ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'bayonnoma')->fileInput() ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'out_bayonnoma')->fileInput() ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'out_dalolatnoma')->fileInput() ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'finish_dalolatnoma')->fileInput() ?>
        </div>
    </div>

    <div class="col-12">
        <input type="submit" class="btn btn-info br-btn" value="Saqlash">
    </div>

    <?php ActiveForm::end() ?>

</div>

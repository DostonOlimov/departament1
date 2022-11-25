<?php

use common\models\control\Instruction;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\control\Instruction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="control-instruction-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'base')->dropDownList(Instruction::getType()) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'letter_date')->widget(DatePicker::className()) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'letter_number')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'command_date')->widget(DatePicker::className()) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'command_number')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'checkup_begin_date')->widget(DatePicker::className()) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'checkup_finish_date')->widget(DatePicker::className()) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

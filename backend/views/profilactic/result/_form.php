<?php

use common\models\Countries;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\profilactic\Result */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="result-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'people')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'certificate_help')->dropDownList([ 0 => 'Berilmadi', 1 => 'Berildi']) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'certificate_text')->textarea() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'measure_help_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'measure_help_count')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'import_export')->dropDownList([ 0 => 'Import', 1 => 'Export']) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'import_export_text')->textarea() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'smk')->dropDownList([ 0 => 'Yordam berilmadi', 1 => 'Yordam berildi']) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'smk_text')->textarea() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'problem')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'decision')->dropDownList([ 0 => 'Tanishtirilmadi', 1 => 'Tanishtirildi']) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'decision_text')->textarea() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

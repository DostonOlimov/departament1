<?php

use common\models\profilactic\Answer;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\control\ProductType;

/* @var $this yii\web\View */
/* @var $model Answer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pro-answer-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'product_type_id')->dropDownList(ArrayHelper::map(ProductType::find()->all(), 'id', 'name')) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'internation_standard')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'product_quality')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'employee')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'smk')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'organization_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'reestr_number')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'validity_period')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'import_product')->textInput(['maxlength' => true, 'placeholder' => 'Vergul bilan ajratib yozing']) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'export_product')->textInput(['maxlength' => true, 'placeholder' => 'Vergul bilan ajratib yozing']) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'international_certificate')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'lab_check')->dropDownList(Answer::labList()) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'all_instruments')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'expired_instruments')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'not_expired_instruments')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'overall_comment')->textarea() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

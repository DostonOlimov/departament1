<?php

use common\models\control\Caution;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\control\Caution */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="caution-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'caution')->dropDownList(Caution::getType(), ['prompt' => '- - -']) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'caution_date')->input('date') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'caution_number')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'file')->fileInput() ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'description')->textarea() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

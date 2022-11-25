<?php

use common\models\profilactic\AnswerStandardCount;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\profilactic\AnswerStandardCount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pro-answer-standard-count-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'type')->dropDownList(AnswerStandardCount::typeList()) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'category')->dropDownList(AnswerStandardCount::categoryList()) ?>
        </div>
    </div>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

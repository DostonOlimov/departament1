<?php

use common\models\Region;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model common\models\profilactic\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pro-company-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'date')->widget(DatePicker::className()) ?>
    <?= $form->field($model, 'number')->textInput() ?>
    <?= $form->field($model, 'description')->textarea() ?>
    <?= $form->field($model, 'deficiency')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

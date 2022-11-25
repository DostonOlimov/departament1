<?php

use common\models\control\PrimaryData;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\control\PrimaryData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="primary-data-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'smt')->dropDownList([
                0 => 'joriy etilgan',
                1 => 'joriy etilmagan'
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'residue_quantity')->textInput() ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'residue_amount')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'potency')->textInput() ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'laboratory')->dropDownList(PrimaryData::getLab()) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'year_quantity')->textInput() ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'year_amount')->textInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

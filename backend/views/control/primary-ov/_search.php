<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PrimaryOvSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="primary-ov-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'control_primary_data_id') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'measurement') ?>

    <?= $form->field($model, 'compared') ?>

    <?php // echo $form->field($model, 'invalid') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

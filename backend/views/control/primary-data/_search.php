<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\control\PrimaryDataSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="primary-data-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'control_company_id') ?>

    <?= $form->field($model, 'residue_quantity') ?>

    <?= $form->field($model, 'residue_amount') ?>

    <?= $form->field($model, 'potency') ?>

    <?php // echo $form->field($model, 'year_quantity') ?>

    <?php // echo $form->field($model, 'year_amount') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'laboratory') ?>

    <?php // echo $form->field($model, 'smt') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\profilactic\ResultSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="result-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'pro_company_id') ?>

    <?= $form->field($model, 'help_name') ?>

    <?= $form->field($model, 'help_count') ?>

    <?= $form->field($model, 'active_name') ?>

    <?php // echo $form->field($model, 'active_count') ?>

    <?php // echo $form->field($model, 'standard_name') ?>

    <?php // echo $form->field($model, 'standard_count') ?>

    <?php // echo $form->field($model, 'certificate_help') ?>

    <?php // echo $form->field($model, 'certificate_text') ?>

    <?php // echo $form->field($model, 'measure_help_name') ?>

    <?php // echo $form->field($model, 'measure_help_count') ?>

    <?php // echo $form->field($model, 'import_export') ?>

    <?php // echo $form->field($model, 'import_export_text') ?>

    <?php // echo $form->field($model, 'smk') ?>

    <?php // echo $form->field($model, 'smk_text') ?>

    <?php // echo $form->field($model, 'decision') ?>

    <?php // echo $form->field($model, 'decision_text') ?>

    <?php // echo $form->field($model, 'problem') ?>

    <?php // echo $form->field($model, 'people') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

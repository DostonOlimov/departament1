<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\control\Laboratory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="laboratory-form">

    <?php $form = ActiveForm::begin([
            'enableClientValidation' => false
    ]); ?>

  <div class="row ml-3">
      <div class="col-lg-2  col-sm-3">
          <?= $form->field($model, 'dalolatnoma')->fileInput() ?>
      </div>
      <div class="col-lg-2  col-sm-3">
          <?= $form->field($model, 'bayonnoma')->fileInput() ?>
      </div>
      <div class="col-lg-2  col-sm-3">
          <?= $form->field($model, 'out_bayonnoma')->fileInput() ?>
      </div>
      <div class="col-lg-2  col-sm-3">
          <?= $form->field($model, 'out_dalolatnoma')->fileInput() ?>
      </div>
      <div class="col-lg-2  col-sm-3">
          <?= $form->field($model, 'finish_dalolatnoma')->fileInput() ?>
      </div>
  </div>
    <div class="form-group ml-3">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

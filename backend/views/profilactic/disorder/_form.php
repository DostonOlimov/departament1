<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Disorder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="disorder-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'standart')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'certificate')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'metrologic')->textarea(['rows' => 6]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

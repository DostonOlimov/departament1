<?php

use common\models\caution\Instruction;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\caution\Instruction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="instruction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'base')->dropDownList(Instruction::getType()) ?>

    <?= $form->field($model, 'letter_date')->widget(DatePicker::className()) ?>

    <?= $form->field($model, 'letter_number')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use common\models\profilactic\Instruction;
use common\models\ProgramType;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\profilactic\Instruction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pro-instruction-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row col-12">
        <div class="col-lg-6 col-md-12" style="margin-top: 6px;">
            <?= $form->field($model, 'status')->radioList(Instruction::getStatus()) ?>
            <?= $form->field($model, 'subject')->dropDownList(Instruction::getSubject()) ?>
            <?= $form->field($model, 'base')->dropDownList(Instruction::getType()) ?>
        </div>
        <div class="col-lg-6 col-md-12">
            <?= $form->field($model, 'letter_date')->widget(DatePicker::className()) ?>
            <?= $form->field($model, 'letter_number')->textInput() ?>
            <?= $form->field($model, 'program_type')->dropDownList(
                ArrayHelper::map(ProgramType::find()->all(), 'id', 'name'), [
                    'prompt' => 'Tanlang...']
            ) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

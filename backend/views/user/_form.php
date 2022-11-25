<?php

use common\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'username')->textInput() ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'pass')->passwordInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'phone')->widget(MaskedInput::className(), [
                'mask' => '(99)-999-99-99'
            ]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'role')->dropDownList(User::rolesList()) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'name')->textInput() ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'surname')->textInput() ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'fathers_name')->textInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

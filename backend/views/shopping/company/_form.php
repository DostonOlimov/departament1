<?php

use common\models\Region;
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

    <?= $form->field($model, 'region_id')->dropDownList(ArrayHelper::map(Region::find()->all(),'id', 'name')) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'after')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inn')->widget(MaskedInput::className(),[
            'mask' => '999999999'
    ]) ?>

    <?= $form->field($model, 'phone')->widget(MaskedInput::className(),[
        'mask' => '(99)-999-99-99'
    ]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

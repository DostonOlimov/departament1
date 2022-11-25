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

    <div class="row ml-3 mr-3">
        <div class="col-lg-12 col-md-12">
            <?= $form->field($model, 'region_id')->dropDownList(ArrayHelper::map(Region::find()->all(),'id', 'name')) ?>
        </div>
        <div class="col-lg-6 col-md-12">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6 col-md-12">
            <?= $form->field($model, 'inn')->widget(MaskedInput::className(),[
                'mask' => '999999999'
            ]) ?>
        </div>
        <div class="col-lg-6 col-md-12">
            <?= $form->field($model, 'phone')->widget(MaskedInput::className(),[
                'mask' => '(99)-999-99-99'
            ]) ?>
        </div>
        <div class="col-lg-6 col-md-12">
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group ml-3">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

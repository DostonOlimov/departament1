<?php

use common\models\control\ProductType;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\control\PrimaryProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="primary-product-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-md-6">
<!--            --><?//= $form->field($model, 'nd')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'nd_type')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'number_blank')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'number_reestr')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'date_from')->widget(DatePicker::className()) ?>
        </div>
        <div class="col-md-6">

            <?= $form->field($model, 'date_to')->widget(DatePicker::className()) ?>

            <?= $form->field($model, 'product_type_id')->dropDownList(
                ArrayHelper::map(ProductType::find()->all(), 'id', 'name')
            ) ?>

            <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

            <div class="form-group pt-4">
                <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success mt-2 pl-5 pr-5']) ?>
            </div>
        </div>


    </div>

    <?php ActiveForm::end(); ?>

</div>

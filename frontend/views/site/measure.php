<?php

/* @var $this yii\web\View */

/* @var $model ControlMeasure */

use common\models\ControlMeasure;
use frontend\widgets\Steps;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

$this->title = 'Ko\'rsatilgan ta`sir choralar';
$this->params['breadcrumbs'][] = $this->title;
?>


    <div class="page1-1 row ">


        <?= Steps::widget([
            'control_instruction_id' => $model->controlCompany->controlInstruction->id,
            'control_company_id' => $model->control_company_id,
        ]) ?>
        <?php $form = ActiveForm::begin([
            'enableClientValidation' => false
        ]); ?>

        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'type')->dropDownList(ControlMeasure::typeList(), [
                    'prompt' => '- - -',
                    'onchange' => "inputGenerate(event)"
                ]) ?>
            </div>

            <div class="col-6 mt-4">
                <input type="submit" class="btn btn-info br-btn" value="Saqlash">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'date')->widget(DatePicker::className()) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'quantity')->textInput() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'amount')->textInput() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'person')->textInput() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'number_passport')->widget(MaskedInput::className(), [
                    'mask' => 'AA9999999'
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'fine_amount')->textInput() ?>
            </div>
        </div>


        <?php ActiveForm::end(); ?>

    </div>
    <script>
        function inputGenerate(event) {
            if (event.target.value == 3) {
                $(".field-controlmeasure-date").hide()
                $(".field-controlmeasure-quantity").hide()
                $(".field-controlmeasure-amount").hide()
                $(".field-controlmeasure-person").show()
                $(".field-controlmeasure-number_passport").show()
                $(".field-controlmeasure-fine_amount").show()
            } else {
                $(".field-controlmeasure-date").show()
                $(".field-controlmeasure-quantity").show()
                $(".field-controlmeasure-amount").show()
                $(".field-controlmeasure-person").hide()
                $(".field-controlmeasure-number_passport").hide()
                $(".field-controlmeasure-fine_amount").hide()
            }
        }
    </script>
<?php
$this->registerJs('
    $(".field-controlmeasure-person").hide()
    $(".field-controlmeasure-number_passport").hide()
    $(".field-controlmeasure-fine_amount").hide()
');

?>
<?php

use common\models\control\Measure;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model common\models\control\Measure */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="measure-form">

    <?php $form = ActiveForm::begin([
//            'enableClientValidation' => false
    ]); ?>

    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <?= $form->field($model, 'type')->checkboxList(Measure::typeList(), [
                'onchange' => "inputGenerate(event)"
            ])->label('Ko\'rilgan ta`sir choralar') ?>
        </div>


    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <?= $form->field($model, 'ov_date')->widget(DatePicker::className()) ?>
            <?= $form->field($model, 'ov_quantity')->textInput() ?>
            <?= $form->field($model, 'ov_name')->textInput() ?>
        </div>
        <hr>
        <div class="col-sm-12 col-lg-6">
            <?= $form->field($model, 'date')->widget(DatePicker::className()) ?>
            <?= $form->field($model, 'quantity')->textInput() ?>
            <?= $form->field($model, 'amount')->textInput() ?>
        </div>
        <hr>
        <div class="col-sm-12 col-lg-6">
            <?= $form->field($model, 'person')->textInput() ?>
            <?= $form->field($model, 'number_passport')->widget(MaskedInput::className(), [
                'mask' => 'AA9999999'
            ]) ?>
            <?= $form->field($model, 'fine_amount')->textInput() ?>
        </div>
    </div>
    <div class="col-6 mt-4">
        <input type="submit" class="btn btn-info br-btn" value="Saqlash">
    </div>

    <?php ActiveForm::end(); ?>

</div>
    <script>
        const showing = (a,b,c) => {
            $(`.field-measure-${a}`).show()
            $(`.field-measure-${b}`).show()
            $(`.field-measure-${c}`).show()
        }
        const removing = (a,b,c) => {
            $(`.field-measure-${a}`).hide()
            $(`.field-measure-${b}`).hide()
            $(`.field-measure-${c}`).hide()
        }
        const MJ = (s) => s ?  showing('person', 'number_passport', 'fine_amount'): removing('person', 'number_passport', 'fine_amount')
        const OV = (s) => s ?   showing('ov_date', 'ov_quantity', 'ov_name'):  removing('ov_date', 'ov_quantity', 'ov_name')
        const Three = (s) => s ?    showing('date', 'quantity', 'amount'):  removing('date', 'quantity', 'amount')

        function inputGenerate(event) {
            let val = event.target.value , checked = event.target.checked
            const threeChange = (child) => event.path[2].children[child].children[0].checked
            if (checked && val == 1) {
                OV(true)
            }
            if(checked===false && val==1){
                OV(false)
            }
            if (checked && val== 3) {
                MJ(1)
            }
            if (checked === false && val == 3) {
                MJ(0)
            }
            if (checked && val != 3 && val != 1) {
                Three(true)
            }
            if (threeChange(1) === false && threeChange(3) === false && threeChange(4) === false ) {
                Three(false)
            }
        }
    </script>
<?php
$this->registerJs('
    $(".field-measure-person").hide()
    $(".field-measure-number_passport").hide()
    $(".field-measure-fine_amount").hide()
    $(".field-measure-date").hide()
    $(".field-measure-quantity").hide()
    $(".field-measure-amount").hide()
    $(".field-measure-ov_date").hide()
    $(".field-measure-ov_quantity").hide()
    $(".field-measure-ov_name").hide()
');

?>
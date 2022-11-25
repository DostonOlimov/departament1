<?php


use common\models\ControlInstruction;
use frontend\widgets\Steps;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model ControlInstruction */


$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="page1-1 row">

    <?= Steps::widget([
        'control_instruction_id' => null,
        'control_company_id' => null,
    ]) ?>

    <?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'base')->dropDownList(ControlInstruction::getType()) ?>

    <?= $form->field($model, 'command_date')->widget(DatePicker::className()) ?>

    <?= $form->field($model, 'command_number')->textInput() ?>

    <?= $form->field($model, 'letter_date')->widget(DatePicker::className()) ?>

    <?= $form->field($model, 'letter_number')->textInput() ?>

    <div class="col-12">
        <input type="submit" class="btn btn-info br-btn" value="Saqlash">
    </div>

    <?php ActiveForm::end() ?>

</div>

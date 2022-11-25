<?php

/* @var $this yii\web\View */
/* @var $model Instruction */

use common\models\profilactic;
use common\models\profilactic\Instruction;
use common\models\ProgramType;
use common\models\User;
use frontend\widgets\StepsProfilactic;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;
//\yii\helpers\VarDumper::dump($model,12,true);die;
$user = User::findOne(Yii::$app->user->id);

?>


<div class="page1-1 row">

    <?= StepsProfilactic::widget([
        'pro_instruction_id' => null,
        'pro_company_id' => null,
    ]) ?>

    <?php $form = ActiveForm::begin() ?>

    <div class="row col-12">
        <?= $form->field($model, 'fio')->textInput() ?>
    </div>
    <div class="row col-12">
        <div class="col-lg-6 col-md-12" style="margin-top: 6px;">
            <?= $form->field($model, 'status')->radioList(Instruction::getStatus()) ?>
            <?= $form->field($model, 'subject')->dropDownList(Instruction::getSubject()) ?>
            <?= $form->field($model, 'base')->dropDownList(Instruction::getType(), ['onchange' => 'handleChange(event)']) ?>
        </div>
        <div class="col-lg-6 col-md-12">
            <div id="let-date" style="display: none">
                <?= $form->field($model, 'letter_date')->widget(DatePicker::className()) ?>
            </div>
            <div id="let-number" style="display: none">
                <?= $form->field($model, 'letter_number')->textInput() ?>
            </div>
            <?= $form->field($model, 'program_type')->dropDownList(
                ArrayHelper::map(ProgramType::find()->all(), 'id', 'name'), [
                    'prompt' => 'Tanlang...']
            ) ?>
        </div>
    </div>

    <div class="col-12">
        <input type="submit" class="btn btn-info br-btn" value="Saqlash">
    </div>

    <?php ActiveForm::end() ?>

</div>
<script src="/js/jquery.js"></script>

<script>
    function handleChange(event) {
        let value = event.target.value
        console.log(value)
        change(value)
    }
    function change(value) {
        let date = document.getElementById('let-date')
        let number = document.getElementById('let-number')
        if (value == 0) {
            date.style.display = 'none'
            number.style.display = 'none'
        } else {
            date.style.display = 'block'
            number.style.display = 'block'
        }
    }

</script>
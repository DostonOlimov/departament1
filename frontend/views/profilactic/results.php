<?php

/* @var $this yii\web\View */

/* @var $model Result */

use common\models\Countries;
use common\models\Nd;
use common\models\profilactic\Company;
use common\models\profilactic\Result;
use common\models\profilactic\AnswerStandardCount;
use wbraganca\dynamicform\DynamicFormWidget;
use frontend\widgets\StepsProfilactic;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;

/**
 * @var $model Result
 */
?>

<div class="page1-1 row ">
    <?= StepsProfilactic::widget([
        'pro_instruction_id' => Company::findOne($company_id)->pro_instruction_id,
        'pro_company_id' => $company_id,
    ]) ?>
    <?php $form = ActiveForm::begin([
        'id' => 'dynamic-form',
    ]); ?>
    <div class="row">
        <?= $form->field($model, 'people')->textInput() ?>
    </div>

    <?= $this->render('_result_standard_test', [
        'form' => $form,
        'modelStandart' => $modelStandart,
    ]) ?>

    <div class="row">
        <div class="col-12">
            <label for="malaka" class="form-label">Sertifikatlashtirish yuzasidan amaliy yordam va
                ma'lumoti:</label>
            <div class="accordionB">
                <div>
                    <input type="radio" name="panel" id="panel-0">
                    <label for="panel-0" onclick="myFunc(event)" id="resultBtn1" class="p-2">Berilmadi</label>
                </div>
                <div>
                    <input type="radio" name="panel" id="panel-01">
                    <label for="panel-01" onclick="myFunc(event)" id="resultBtn2" class="p-2">Berildi</label>
                    <div class="accordionB__content accordionB__content--med">
                        <h4 class="accordionB__header">Izoh:</h4>
                        <?= $form->field($model, 'certificate_text')->textarea()->label(false) ?>
                    </div>
                </div>
                <?= $form->field($model, 'certificate_help')->hiddenInput(['id' => 'resultHidOne'])->label(false) ?>
            </div>
        </div>
    </div>
    <div class="row">
        <label for="">O'lchov vositalari bo'yicha amaliy yordam (soni va nomi):</label>
        <div style="width: 50%;">
            <?= $form->field($model, 'measure_help_count')->textInput(['placeholder' => 'Soni ...'])->label(false) ?>
        </div>
        <div style="width: 50%;">
            <?= $form->field($model, 'measure_help_name')->textInput(['placeholder' => 'Nomi ...'])->label(false) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-12 imExp">
            <label for="import-export" class="form-label">Import/Export ga amaliy yordam</label>
            <?= $form->field($model, 'import_export')->dropDownList([0 => 'Import', 1 => 'Export'])->label(false) ?>
            <label for="country">Davlatlar</label>
            <span style="color: red !important; display: inline; float: none;">*</span>
            <?= $form->field($model, 'countries')->widget(Select2::class, [
                'data' => ArrayHelper::map(Countries::find()->all(), 'id', 'name'),
                'language' => 'uz',
                'options' => ['multiple' => true],
                'showToggleAll' => false,
            ])->label(false); ?>
            <?= $form->field($model, 'import_export_text')->textarea()->label(false) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-3">
            <label class="form-label">SMT joriy etilishida amaliy yordam:</label>
            <div class="accordionC">
                <div>
                    <input type="radio" name="panel-1" id="panel-1">
                    <label for="panel-1" onclick="myFunc(event)" id="resultBtn3" class="p-2"> Yordam berilmadi</label>
                </div>
                <div>
                    <input type="radio" name="panel-1" id="panel-2">
                    <label for="panel-2" onclick="myFunc(event)" id="resultBtn4" class="p-2"> Yordam berildi</label>
                    <div class="accordionC__content accordionC__content--med">
                        <h4 class="accordionC__header">Izoh:</h4>
                        <?= $form->field($model, 'smk_text')->textarea()->label(false) ?>
                    </div>
                    <?= $form->field($model, 'smk')->hiddenInput(['id' => 'resultHidTwo'])->label(false) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-3">
            <label for="malaka" class="form-label">Sohaga oid qonun va qarorlar bilan tanishtirish:</label>
            <div class="accordionD">
                <div>
                    <input type="radio" name="panel-2" id="panel-3">
                    <label for="panel-3" onclick="myFunc(event)" id="resultBtn5" class="p-2">Tanishtirilmadi</label>
                </div>
                <div>
                    <input type="radio" name="panel-2" id="panel-4">
                    <label for="panel-4" onclick="myFunc(event)" id="resultBtn6" class="p-2">Tanishtirildi</label>
                    <div class="accordionD__content accordionD__content--med">
                        <h4 class="accordionD__header">Izoh:</h4>
                        <?= $form->field($model, 'decision_text')->textarea()->label(false) ?>
                    </div>
                </div>
                <?= $form->field($model, 'decision')->hiddenInput(['id' => 'resultHidThree'])->label(false) ?>
            </div>
        </div>
    </div>
    <div class="row">
        <?= $form->field($model, 'problem')->textInput() ?>
    </div>
    <?= $this->render('_form_double_dynamic', [
        'answerStandardCount' => $answerStandardCount,
        'form' => $form,
        'modelsRoom' => $modelsRoom,
    ])
    ?>
    <div class="col-12 mt-3">
        <input type="submit" class="btn btn-info br-btn" value="Saqlash">
    </div>
    <?php ActiveForm::end(); ?>
</div>

<script>
    const myFunc = (event) => {
        // let valueOne = $("#resultHidOne")
        let valueOne = document.getElementById("resultHidOne")
        let valueTwo = document.getElementById("resultHidTwo")
        let valueThree = document.getElementById("resultHidThree")
        let id = event.target.id
        if (id === "resultBtn1") {
            valueOne.value = 0;
            valueOne.style.backgroundColor = "yellow !important"
        } else if (id === "resultBtn2") {
            valueOne.value = 1;
        } else if (id === "resultBtn3") {
            valueTwo.value = 0;
        } else if (id === "resultBtn4") {
            valueTwo.value = 1;
        } else if (id === "resultBtn5") {
            valueThree.value = 0;
        } else if (id === "resultBtn6") {
            valueThree.value = 1;
        }
    }
</script>
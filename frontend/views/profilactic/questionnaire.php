<?php

/* @var $this yii\web\View */
/* @var $model Answer */

/* @var $answerStandardCount AnswerStandardCount */

use common\models\control\ProductType;
use common\models\Countries;
use common\models\profilactic\Answer;
use common\models\profilactic\AnswerStandardCount;
use common\models\profilactic\Company;
use frontend\widgets\StepsProfilactic;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;


$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;
?>


<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<div class="page1-1 row">
    <?= StepsProfilactic::widget([
        'pro_instruction_id' => Company::findOne($model->pro_company_id)->pro_instruction_id,
        'pro_company_id' => $model->pro_company_id,
    ]) ?>
    <?php $form = ActiveForm::begin([
        'id' => 'dynamic-form',
    ]); ?>
    <div class="row col-12">
        <div>
            <?= $form->field($model, 'product_type_id')->dropDownList(ArrayHelper::map(ProductType::find()->all(), 'id', 'name')) ?>
        </div>
        <div class="col-lg-6 col-md-12">
            <?= $form->field($model, 'product_name')->textInput() ?>
        </div>
        <div class="col-lg-6 col-md-12">
            <?= $form->field($model, 'internation_standard')->textInput() ?>
        </div>
        <div class="col-lg-6 col-md-12">
            <?= $form->field($model, 'product_quality')->textInput() ?>
        </div>
        <div class="col-lg-6 col-md-12">
            <?= $form->field($model, 'employee')->textInput() ?>
        </div>
        <div class="col-lg-6 col-md-12">
            <?= $form->field($model, 'smk')->textInput() ?>
        </div>
        <div class="col-lg-6 col-md-12">
            <?= $form->field($model, 'international_certificate')->textInput() ?>
        </div>
    </div>

    <div class="row col-12">
        <div class="col-lg-6 col-md-12">
            <h5 class="text-black mt-3">Import</h5>
            <label>Davlat nomi</label>
            <?= $form->field($model, 'import')->widget(Select2::class, [
                'data' => ArrayHelper::map(Countries::find()->all(), 'id', 'name'),
                'language' => 'uz',
                'options' => ['multiple' => true],
                'showToggleAll' => false,
            ])->label(false) ?>
            <label for="productName">Mahsulot nomi</label>
            <div id="import_products"></div>
            <input type="text" class="form-control mt-3" id="productName" onchange="HandleImportChange(event)">
            <button type="button" class="btn btn-primary btn-sm mt-3" style="border-radius: 25px;"
                    onclick="HandleAddImport(event)">Mahsulotni qo'shish
            </button>
            <?= $form->field($model, 'import_product')->hiddenInput([
                'id' => 'import_prod'
            ])->label(false) ?>
        </div>
        <div class="col-lg-6 col-md-12">
            <h5 class="text-black mt-3">Eksport</h5>
            <label>Davlat nomi</label>
            <?= $form->field($model, 'export')->widget(Select2::class, [
                'data' => ArrayHelper::map(Countries::find()->all(), 'id', 'name'),
                'language' => 'uz',
                'options' => ['multiple' => true],
                'showToggleAll' => false,
            ])->label(false) ?>
            <label for="prouctName1">Mahsulot nomi</label>
            <div id="export_products"></div>
            <input type="text" class="form-control mt-3" id="productName1" onchange="HandleExportChange(event)">
            <button type="button" class="btn btn-primary btn-sm mt-3" style="border-radius: 25px;"
                    onclick="HandleAddExport(event)">Mahsulotni qo'shish
            </button>
            <?= $form->field($model, 'export_product')->hiddenInput([
                'id' => 'export_prod'
            ])->label(false) ?>
        </div>
    </div>
    <div class="row mt-5">
        <div class="row col-lg-6 col-md-12">
            <h3 class="text-black">Muvofiqlik sertifikati</h3>
            <div class="col-lg-12 col-md-12">
                <?= $form->field($model, 'organization_name')->textInput() ?>
            </div>
            <div class="col-lg-12 col-md-12">
                <?= $form->field($model, 'reestr_number')->textInput() ?>
            </div>
            <div class="col-lg-12 col-md-12">
                <?= $form->field($model, 'validity_period')->widget(DatePicker::className()) ?>
            </div>
        </div>
        <div class="row col-lg-6 col-md-12">
            <h3 class="text-black">O'lchash vositalari</h3>
            <div class="col-lg-12 col-md-12">
                <?= $form->field($model, 'all_instruments')->textInput() ?>
            </div>
            <div class="col-lg-12 col-md-12">
                <?= $form->field($model, 'expired_instruments')->textInput() ?>
            </div>
            <div class="col-lg-12 col-md-12">
                <?= $form->field($model, 'not_expired_instruments')->textInput() ?>
            </div>
        </div>
    </div>
    <div class="row mt-5 col-12">
        <?= $this->render('_form', [
            'model' => $answerStandardCount,
            'form' => $form,
        ]) ?>
    </div>
    <div class="row col-md-12 col-sm-12  btn-group " role="group" aria-label="Basic example">
        <label for="prouctNameExp" class="form-label mt-3">Sinov labaratoriyasining mavjudliligi:</label>
        <button type="button" class="btn btn-primary  btnColor  text-white " onclick="myFunc(event)" id="questionBtn1">
            <?= Answer::labList(Answer::LAB_AVAILABLE) ?>
        </button>
        <button type="button" class="btn btn-primary btnColor  text-white  mt-3" onclick="myFunc(event)"
                id="questionBtn2">
            <?= Answer::labList(Answer::LAB_CONTRACT) ?>
        </button>
        <button type="button" class="btn btn-primary btnColor  text-white  mt-3" onclick="myFunc(event)"
                id="questionBtn3">
            <?= Answer::labList(Answer::LAB_ABSENT) ?>
        </button>
    </div>
       <?= $form->field($model, 'lab_check')->hiddenInput([
           'id' => 'questionHid'
       ])->label(false) ?>
    <div class="col-12 mt-3">
        <input type="submit" class="btn btn-info br-btn" value="Saqlash">
    </div>
    <?php ActiveForm::end(); ?>
</div>

<script>
    let import_products = []
    let export_products = []
    const Chip = (text) => {
        let span = document.createElement("span")
        span.className = "btn-outline-primary chip"
        span.innerHTML = text
        return span
    }
    const HandleAdd = (box, e, input) => {
        let products = document.getElementById(box)
        let val = e.target.parentElement.children[input].value + `<span class="btn-close ml-3 color-danger closeButton" style="padding:5px" onclick={closeBtn(event)} ></span>`
        e.target.parentElement.children[input].value !== '' ? products.append(Chip(val)) : ''
        e.target.parentElement.children[input].value = ''
    }
    const HandleImportChange = (e) => {
        import_products.push(e.target.value)
        let imp_prod = document.getElementById("import_prod")
        imp_prod.value = import_products
        console.log(import_products);
    }
    const HandleExportChange = (e) => {
        export_products.push(e.target.value)
        let exp_prod = document.getElementById("export_prod")
        exp_prod.value = export_products
        console.log(export_products);
    }
    const HandleAddImport = (e) => {
        HandleAdd("import_products", e, 5)
    }
    const HandleAddExport = (e) => {
        HandleAdd("export_products", e, 5)
    }
    const closeBtn = (e) => {
        let val = e.target.parentElement
        val.remove()
        console.log(e);
    }
    let has = true,
        contract = true,
        hasnt = true

    function myFunc(event) {
        let lab_check = document.getElementById("questionHid")
        let export_or_import = document.getElementById("import_or_export")
        let btn1 = document.getElementById("questionBtn1")
        let btn2 = document.getElementById("questionBtn2")
        let btn3 = document.getElementById("questionBtn3")

        let id = event.target.id
        let green = "#117508", blue = "#0d6efd"

        if (id === "questionBtn1") {
            has = !has
            if (has === false) {
                hasnt = true
                btn1.style.backgroundColor = green
                btn3.style.backgroundColor = blue
                if (has === false && contract === false) {
                    lab_check.value = '1,2'
                } else {
                    lab_check.value = 1;
                }
            } else {
                btn1.style.backgroundColor = blue
            }
        }

        if (id === "questionBtn2") {
            contract = !contract
            if (contract === false) {
                hasnt = true
                btn2.style.backgroundColor = green
                btn3.style.backgroundColor = blue
                if (has === false && contract === false) {
                    lab_check.value = '1,2'
                } else {
                    lab_check.value = 2;
                }
            } else {
                btn2.style.backgroundColor = blue
            }
        }

        if (id === "questionBtn3") {
            hasnt = !hasnt
            if (hasnt === false) {
                has = true
                contract = true
                btn1.style.backgroundColor = blue
                btn2.style.backgroundColor = blue
                btn3.style.backgroundColor = green
            } else {
                btn3.style.backgroundColor = blue
            }
            lab_check.value = 3;
            console.log(lab_check.value);

        }
        if (id === "export") {
            export_or_import.value = 1;
        }
        if (id === "import") {
            export_or_import.value = 0;
        }
        console.log("tawqarda" + lab_check.value);
    }
</script>
<?php

/* @var $this yii\web\View */

/* @var $model Measure */

use common\models\control\Measure;
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
            <div class="col-sm-12 col-lg-12">
                <?= $form->field($model, 'type')->checkboxList(Measure::typeList(), [
                    'onchange' => "inputGenerate(event)"
                ])->label('Ko\'rilgan ta`sir choralar') ?>
            </div>


        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-6" >
                <hr>
                <div id="titleOv" style="color: #000;"></div>
                <?= $form->field($model, 'ov_date')->widget(DatePicker::className()) ?>
                <?= $form->field($model, 'ov_quantity')->textInput() ?>
                <?= $form->field($model, 'ov_name')->textInput() ?>
            </div>
            <div class="col-sm-6 col-lg-6">
                <hr>
                <div id="titlePerson" style="color: #000;"></div>
                <?= $form->field($model, 'person')->textInput() ?>
                <?= $form->field($model, 'number_passport')->widget(MaskedInput::className(), [
                    'mask' => 'AA9999999'
                ]) ?>
                <?= $form->field($model, 'fine_amount')->textInput() ?>
            </div>
            <div class="col-sm-12 col-lg-6">
                <hr>
                <div id="titleRe" style="color: #000;"></div>
                <?= $form->field($model, 'date')->widget(DatePicker::className()) ?>
                <?= $form->field($model, 'quantity')->textInput() ?>
                <?= $form->field($model, 'amount')->textInput() ?>
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

                let node = document.createElement("span");
                node.setAttribute("id", "span1");// Create a <li> node
                let textnode = document.createTextNode("O'.V taqiqlash.");         // Create a text node
                node.appendChild(textnode);                              // Append the text to <li>
                document.getElementById("titleOv").appendChild(node);

                OV(true)
            }

            if(checked===false && val==1){
                $("#span1").remove();
                OV(false)
            }

            if (checked && val== 3) {
                let person = document.createElement("span");
                person.setAttribute("id", "span3");// Create a <li> node
                let personText = document.createTextNode("Jarimaga tortilgan shaxs.");         // Create a text node
                person.appendChild(personText);                              // Append the text to <li>
                document.getElementById("titlePerson").appendChild(person);
                MJ(1)
            }

            if (checked && val== 2) {
                let re2 = document.createElement("span");
                re2.setAttribute("id", "span2");// Create a <li> node
                let reText = document.createTextNode("Realizatsiyani taqiqlash. ");         // Create a text node
                re2.appendChild(reText);                              // Append the text to <li>
                document.getElementById("titleRe").appendChild(re2);
            }

            if(checked===false && val==2){
                $("#span2").remove();
            }

            if (checked && val== 4) {
                let re4 = document.createElement("span");
                re4.setAttribute("id", "span4");// Create a <li> node
                let re4Text = document.createTextNode("Iqtisodiy jarima. ");         // Create a text node
                re4.appendChild(re4Text);                              // Append the text to <li>
                document.getElementById("titleRe").appendChild(re4);
            }

            if(checked===false && val==4){
                $("#span4").remove();
            }

            if (checked && val== 5) {
                let re5 = document.createElement("span");
                re5.setAttribute("id", "span5");// Create a <li> node
                let re5Text = document.createTextNode("Savdodan chiqarish. ");         // Create a text node
                re5.appendChild(re5Text);                              // Append the text to <li>
                document.getElementById("titleRe").appendChild(re5);
            }

            if(checked===false && val==5){
                $("#span5").remove();
            }

            if (checked === false && val == 3) {
                $("#span3").remove();
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
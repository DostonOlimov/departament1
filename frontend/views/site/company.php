<?php

use common\models\ControlCompany;
use common\models\Region;
use frontend\widgets\Steps;
use yii\helpers\ArrayHelper;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;


/* @var $this View */
/* @var $form ActiveForm */
/* @var $model ControlCompany */

$this->title = 'Korxona';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page1-1 row">

    <?= Steps::widget([
        'control_instruction_id' => $model->control_instruction_id,
        'control_company_id' => null,
    ]) ?>

    <?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'inn')->textInput() ?>

    <?= $form->field($model, 'region_id')->dropDownList(ArrayHelper::map(Region::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'soogu')->textInput() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'phone')->widget(MaskedInput::className(), [
            'mask' => '(99)-999-99-99'
    ]) ?>

    <?= $form->field($model, 'address')->textInput() ?>


    <div class="col-12">
        <input type="submit" class="btn btn-info br-btn" value="Saqlash">
    </div>

    <?php ActiveForm::end() ?>
<!--
    <div class=" col-12 mt-3">
        <button type="button" class="btn btn-secondary" id="location-button">Get geolocation</button>
        <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&q=Eiffel+Tower+Paris+France" frameborder="0" style="border:0; width: 100%; height: 30vh;" allowfullscreen>
        </iframe>
    </div>-->

</div>
<script src="/js/jquery.js"></script>
<script>

    let geoBtn  = document.getElementById("location-button")

    geoBtn.addEventListener("click" , function () {
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(function (position) {
                console.log(position)
                $.get("https://maps.googleapis.com/maps/api/geocode/json?latlng=" + position.coords.latitude+','+position.coords.longitude+"&sensor=false" , function (data){
                    console.log(data)
                })
            })
        } else
        {
            console.log('geolocation is not supported')
        }
    })

</script>
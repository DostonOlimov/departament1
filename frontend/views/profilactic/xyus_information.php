<?php

/* @var $this yii\web\View */
/* @var $model Company */

use common\models\profilactic\Company;
use common\models\Region;
use frontend\widgets\StepsProfilactic;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="page1-1 row ">

    <?= StepsProfilactic::widget([
        'pro_instruction_id' => $model->pro_instruction_id,
        'pro_company_id' => null,
    ]) ?>

    <?php $form = ActiveForm::begin() ?>
    <div class="row col-12">
        <div class="col-lg-6 col-md-12">
            <?= $form->field($model, 'name')->textInput() ?>

            <?= $form->field($model, 'inn')->widget(MaskedInput::className(), [
                'mask' => '999999999'
            ]) ?>

            <?= $form->field($model, 'phone')->widget(MaskedInput::className(), [
                'mask' => '(99) 999-99-99'
            ]) ?>
        </div>
        <div class="col-lg-6 col-md-12">
            <?= $form->field($model, 'region_id')->dropDownList(ArrayHelper::map(Region::find()->all(), 'id', 'name')) ?>

            <?= $form->field($model, 'address')->textInput() ?>
        </div>
    </div>
    <div class="col-12">
        <input type="submit" class="btn btn-info br-btn" value="Saqlash">
    </div>
    <?php ActiveForm::end() ?>

    <!--            <div class=" mt-3">-->
    <!--                <button type="button" class="btn btn-secondary" id="location-button">Get geolocation</button>-->
    <!--                <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&q=Eiffel+Tower+Paris+France" frameborder="0" style="border:0; width: 100%; height: 30vh;" allowfullscreen>-->
    <!--                </iframe>-->
    <!--            </div>-->
</div>
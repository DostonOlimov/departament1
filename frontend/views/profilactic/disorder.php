<?php

/* @var $this yii\web\View */

/* @var $model Disorder */

use common\models\Disorder;
use frontend\widgets\StepsProfilactic;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;

$this->title = 'Qonun buzish xolatlari formasi';
$this->params['breadcrumbs'][] = $this->title;
//\yii\helpers\VarDumper::dump($model,12,true);die;

?>


<div class="page1-1 row">

    <?= StepsProfilactic::widget([
        'pro_instruction_id' => \common\models\profilactic\Company::findOne($model->company_id)->pro_instruction_id,
        'pro_company_id' => $model->company_id,
    ]) ?>

    <?php $form = ActiveForm::begin() ?>

    <div class="row col-md-12">
        <?= $form->field($model, 'standart')->textarea() ?>
        <?= $form->field($model, 'certificate')->textarea() ?>
        <?= $form->field($model, 'metrologic')->textarea() ?>

    </div>

    <div class="col-12">
        <input type="submit" class="btn btn-info br-btn" value="Saqlash">
    </div>

    <?php ActiveForm::end() ?>

</div>
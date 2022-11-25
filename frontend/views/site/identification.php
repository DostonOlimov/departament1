<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model ControlIdentification */


use common\models\ControlIdentification;
use frontend\widgets\Steps;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;

$this->title = 'Korxona';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="page1-1 row">

    <?= Steps::widget([
        'control_instruction_id' => $model->controlCompany->controlInstruction->id,
        'control_company_id' => $model->control_company_id,
    ]) ?>

    <?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'file')->widget(FileInput::className(), [
        'options' => ['accept' => 'image/*'],
        'language' => 'uz',
        'pluginOptions' => [
            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'browseClass' => 'btn btn-primary btn-block',
            // 'browseIcon' => ' ',
            'browseLabel' => 'Surat',
            'layoutTemplates' => [
                'main1' => '<div class="kv-upload-progress hide"></div>{remove}{cancel}{upload}{browse}{preview}',
            ]
        ]
    ]) ?>

    <?= $form->field($model, 'identification')->textarea() ?>

    <div class="col-12">
        <input type="submit" class="btn btn-info br-btn" value="Saqlash">
    </div>

    <?php ActiveForm::end() ?>

</div>


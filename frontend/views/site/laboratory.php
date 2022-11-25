<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model Laboratory */


use common\models\Laboratory;
use frontend\widgets\Steps;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;

$this->title = 'Na`muna olish va labaratoriya natijalari';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page1-1 row">

    <?= Steps::widget([
        'control_instruction_id' => $model->controlCompany->controlInstruction->id,
        'control_company_id' => $model->control_company_id,
    ]) ?>

    <?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'dalolatnoma')->widget(FileInput::className(), [
        'language' => 'uz',
        'pluginOptions' => [
            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'browseClass' => 'btn btn-primary btn-block',
            // 'browseIcon' => ' ',
            'browseLabel' => 'File',
            'layoutTemplates' => [
                'main1' => '<div class="kv-upload-progress hide"></div>{remove}{cancel}{upload}{browse}{preview}',
            ]
        ]
    ]) ?>
    <?= $form->field($model, 'bayonnoma')->widget(FileInput::className(), [
        'language' => 'uz',
        'pluginOptions' => [
            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'browseClass' => 'btn btn-primary btn-block',
            // 'browseIcon' => ' ',
            'browseLabel' => 'File',
            'layoutTemplates' => [
                'main1' => '<div class="kv-upload-progress hide"></div>{remove}{cancel}{upload}{browse}{preview}',
            ]
        ]
    ]) ?>

    <div class="col-12">
        <input type="submit" class="btn btn-info br-btn" value="Saqlash">
    </div>

    <?php ActiveForm::end() ?>

</div>

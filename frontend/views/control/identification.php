<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model Identification */


use common\models\control\Company;
use common\models\control\Identification;
use frontend\widgets\Steps;
use kartik\file\FileInput;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\widgets\ActiveForm;

$this->title = 'Korxona';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="page1-1 row">

    <?= Steps::widget([
        'control_instruction_id' => Company::findOne($company_id)->control_instruction_id,
        'control_company_id' => $company_id,
    ]) ?>

    <?php $form = ActiveForm::begin([
//        'enableClientValidation' => false,
//        'enableAjaxValidation' => true,
//        'validateOnChange' => true,
//        'validateOnBlur' => false,
        'options' => [
            'enctype' => 'multipart/form-data',
            'id' => 'dynamic-form'
        ]
        ]) ?>


    <div class="row">
        <div class="box box-default" style="display: inline-block">
            <div class="panel-body">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
//                        'limit' => 7, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
                    'model' => $model[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        'file',
                        'identification',
                    ],
                ]); ?>

                <div class="container-items"><!-- widgetContainer -->
                    <?php foreach ($model as $i => $stan): ?>
                        <div class="item panel panel-default item-product"><!-- widgetBody -->
                            <div class="panel-heading">
                                <div class="pull-right">
                                    <button type="button" class="add-item btn btn-success btn-xs"><i
                                                class="fa fa-plus"></i></button>
                                    <button type="button" class="remove-item btn btn-danger btn-xs"><i
                                                class="fa fa-minus"></i></button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <?= $form->field($stan, "[{$i}]file")->input('file') ?>
                                    </div>
                                    <div class="col-md-9">
                                        <?= $form->field($stan, "[{$i}]identification")->textarea() ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php DynamicFormWidget::end(); ?>
            </div>
        </div>
    </div>

    <div class="col-12">
        <input type="submit" class="btn btn-info br-btn" value="Saqlash">
    </div>

    <?php ActiveForm::end() ?>

</div>


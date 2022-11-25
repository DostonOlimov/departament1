<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model ControlPrimaryData */

use common\models\ControlPrimaryData;
use frontend\widgets\Steps;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\widgets\ActiveForm;

$this->title = 'Birlamchi ma`lumotlar';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page1-1 row ">


    <?= Steps::widget([
        'control_instruction_id' => $model->controlCompany->controlInstruction->id,
        'control_company_id' => $model->control_company_id,
    ]) ?>

    <?php $form = ActiveForm::begin([
        'id' => 'dynamic-form'
    ]) ?>

    <?= $form->field($model, 'count')->textInput() ?>

    <?= $form->field($model, 'product_type')->textInput() ?>

    <?= $form->field($model, 'certificate')->textInput() ?>

    <?= $form->field($model, 'residue_quantity')->textInput() ?>

    <?= $form->field($model, 'residue_amount')->textInput() ?>

    <?= $form->field($model, 'potency')->textInput() ?>

    <?= $form->field($model, 'year_quantity')->textInput() ?>

    <?= $form->field($model, 'year_amount')->textInput() ?>

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
                    'model' => $products[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        'name',
                        'document',
//                    'count',
                        // 'incoming_price',
                        // 'incoming_value',
                    ],
                ]); ?>

                <div class="container-items"><!-- widgetContainer -->
                    <?php foreach ($products as $i => $stan): ?>
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
                                    <div class="col-md-6 mt-1">
                                        <?= $form->field($stan, "[{$i}]name")->textInput() ?>
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <?= $form->field($stan, "[{$i}]document")->textInput() ?>
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

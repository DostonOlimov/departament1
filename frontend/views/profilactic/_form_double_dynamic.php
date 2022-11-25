<?php
use common\models\Nd;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;

?>

<div class="row">
    <?php

    DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper',
        'widgetBody' => '.house-items',
        'widgetItem' => '.house-item',
        'limit' => 10,
        'min' => 1,
        'insertButton' => '.add-house',
        'deleteButton' => '.remove-house',
        'model' => $answerStandardCount[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'description',
            'nd_id',
        ],
    ]); ?>

    <table class="table table-bordered table-striped ">
        <thead>
        <tr>
            <th style="width:35vw">Me'yoriy hujjatlarni aktuallashtirish</th>
            <th>Muddati o'tgan standartlar</th>
        </thead>
        <tbody class="house-items">
        <?php foreach ($answerStandardCount as $indexHouse => $modelHouse): ?>
            <tr class="house-item">
                <td class="vcenter col-lg-12 col-md-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <?= $form->field($modelHouse, "[{$indexHouse}]nd_id")->dropDownList(ArrayHelper::map(Nd::find()->all(), 'id', 'name'), ['prompt' => 'Tanlang...'])->label(false) ?>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <?= $form->field($modelHouse, "[{$indexHouse}]description")->label(false)->textInput(['maxlength' => true, 'placeholder' => '...']) ?>
                        </div>
                    </div>
                </td>
                <td >
                    <?= $this->render('_form-rooms', [
                        'form' => $form,
                        'indexHouse' => $indexHouse,
                        'modelsRoom' => $modelsRoom[$indexHouse],
                    ]) ?>
                </td>
                <td class="text-center vcenter" style="width: 90px;">
                    <button type="button" class="add-house btn btn-success btn-xs mt-2"><span class="fa fa-plus"></span></button>
                    <button type="button" class="remove-house btn btn-danger btn-xs mt-3"><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php DynamicFormWidget::end(); ?>
</div>
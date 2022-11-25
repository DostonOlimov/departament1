<?php

use common\models\profilactic\AnswerStandardCount;
use wbraganca\dynamicform\DynamicFormWidget;

?>

<div id="panel-option-values" class="panel panel-default mt-2">
    <div class="panel-heading">
        <h3 class="panel-title text-black"><i class="fa fa-check-square-o"></i> Foydalanilayotgan standartlari soni</h3>
    </div>

    <?php

    DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper',
        'widgetBody' => '.form-options-body',
        'widgetItem' => '.form-options-item',
        'min' => 1,
        'insertButton' => '.add-item',
        'deleteButton' => '.delete-item',
        'model' => $model[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'name',
            'category',
            'type'
        ],
    ]); ?>

    <table class="table  table-striped margin-b-none">
        <tbody class="form-options-body">
        <?php foreach ($model as $index => $modelOptionValue): ?>
            <tr class="form-options-item">
                <!-- <td class="sortable-handle text-center vcenter" style="cursor: move;">
                    <i class="fa fa-arrows"></i>
                </td> -->
                <td class="vcenter">
                <div class="row">
                        <div class="col-md-6" >
                            <?= $form->field($modelOptionValue, "[{$index}]name")->textInput(['maxlength' => 128]); ?>
                        </div>
                        <div class="col-md-6" >
                            <?= $form->field($modelOptionValue, "[{$index}]category")->dropDownList(AnswerStandardCount::categoryList()); ?>
                        </div>
                       <div class="col-md-6" >
                            <?= $form->field($modelOptionValue, "[{$index}]type")->dropDownList(AnswerStandardCount::typeList()) ?>                    
                        </div>

                        <div class="col-md-6 d-flex align-items-end mb-3 float-right" >
                            <button type="button" class="delete-item btn btn-danger btn-sm float-right"><i class="fa fa-minus mr-1"></i>O'chirish</button>
                            <button type="button" class="add-item btn btn-success btn-sm float-right ml-2"><span class="fa fa-plus"></span> Qo'shish</button> 
                        </div>
                    
                </div>
                </td>
                <!-- <td class="text-center vcenter">
                    <button type="button" class="delete-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                </td> -->
            </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
        <tr>
            <!-- <td colspan="3"></td> -->
            <!-- <td>qoshish buttoni bor edi </td> -->
        </tr>
        </tfoot>
    </table>
    <?php DynamicFormWidget::end(); ?>
</div>

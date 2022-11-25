<?php

use common\models\Nd;
use frontend\models\ResultLastDataForm;
use yii\helpers\ArrayHelper;
use wbraganca\dynamicform\DynamicFormWidget;

?>

<div class="container-items">
    <div class="item panel panel-default item-product">
        <div class="panel-heading mb-2">
            <div class="pull-right">
                <button type="button" class="add-item btn btn-success btn-xs"><i class="fa fa-plus"></i></button>
                <button type="button" class="remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <?= $form->field($modelStandart[0], "[0]category")->label(false)->dropDownList(ResultLastDataForm::categoryList(), ['onchange' => 'handleChange(event)']) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($modelStandart[0], "[0]help_name")->dropDownList(
                        ArrayHelper::map(Nd::find()->all(), 'id', 'name'), [
                        'prompt' => 'Tanlang...'
                    ]) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($modelStandart[0], "[0]help_count")->textInput([
                        'maxlength' => true,
                        'placeholder' => '...'
                    ]) ?>
                </div>
                <div class="col-sm-6" style="display: none;">
                    <?= $form->field($modelStandart[0], "[0]standard_name")->dropDownList(
                        ArrayHelper::map(Nd::find()->all(), 'id', 'name'), [
                        'prompt' => 'Tanlang...'
                    ]) ?>
                </div>
                <div class="col-sm-6" style="display: none;">
                    <?= $form->field($modelStandart[0], "[0]standard_count")->textInput([
                        'maxlength' => true,
                        'placeholder' => '...'
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/js/jquery.js"></script>
<script>
    function handleChange(event) {
        let index = event.target.id.match(/\d+/)[0]
        let value = event.target.value
        change(value, index)
    }
    function change(value, index) {
        if (value == 2) {
            $('#resultlastdataform-' + index + '-help_count').parent().parent().hide()
            $('#resultlastdataform-' + index + '-help_name').parent().parent().hide()

            $('#resultlastdataform-' + index + '-standard_count').parent().parent().show()
            $('#resultlastdataform-' + index + '-standard_name').parent().parent().show()
        } else {
            $('#resultlastdataform-' + index + '-standard_count').parent().parent().hide()
            $('#resultlastdataform-' + index + '-standard_name').parent().parent().hide()

            $('#resultlastdataform-' + index + '-help_count').parent().parent().show()
            $('#resultlastdataform-' + index + '-help_name').parent().parent().show()
        }
    }

    $(".add-item").click(function (eventObj) {

        let a = '<div class="container-items">' +
                    '<div class="item panel panel-default item-product">' +
                        '<div class="panel-heading mb-2">' +
                            '<div class="pull-right">' +
                                '<button type="button" class="add-item btn btn-success btn-xs"><i class="fa fa-plus" aria-hidden="true"></i></button>' +
                                '<button type="button" class="remove-item btn btn-danger btn-xs"><i class="fa fa-minus" aria-hidden="true"></i></button>' +
                            '</div>' +
                        '<div class="clearfix"></div>' +
                    '</div>' +
                    '<div class="panel-body">' +
                    '<div class="row">
                        <div class="col-sm-12">
                            <div class="form-group field-resultlastdataform-0-category">

                                <select id="resultlastdataform-0-category" class="form-control" name="ResultLastDataForm[0][category]" onchange="handleChange(event)">
                                    <option value="1">Me'yoriy hujjat bilan ta'minlash yuzasidan amaliy yordam</option>
                                    <option value="2">Xalqaro standartlarni joriy etish</option>
                                </select>

                                <div class="help-block"></div>
                            </div>                </div>
                        <div class="col-sm-6">
                            <div class="form-group field-resultlastdataform-0-help_name">
                                <label class="control-label" for="resultlastdataform-0-help_name">Me'yoriy hujjat bilan ta'minlash yuzasidan amaliy yordam nomi</label>
                                <select id="resultlastdataform-0-help_name" class="form-control" name="ResultLastDataForm[0][help_name]">
                                    <option value="">Tanlang...</option>
                                    <option value="1">GOST ISO 9001</option>
                                </select>

                                <div class="help-block"></div>
                            </div>                </div>
                        <div class="col-sm-6">
                            <div class="form-group field-resultlastdataform-0-help_count">
                                <label class="control-label" for="resultlastdataform-0-help_count">Me'yoriy hujjat bilan ta'minlash yuzasidan amaliy yordam soni</label>
                                <input type="text" id="resultlastdataform-0-help_count" class="form-control" name="ResultLastDataForm[0][help_count]" placeholder="...">

                                    <div class="help-block"></div>
                            </div>                </div>
                        <div class="col-sm-6" style="display: none;">
                            <div class="form-group field-resultlastdataform-0-standard_name">
                                <label class="control-label" for="resultlastdataform-0-standard_name">Xalqaro standartlarni joriy etish nomi</label>
                                <select id="resultlastdataform-0-standard_name" class="form-control" name="ResultLastDataForm[0][standard_name]">
                                    <option value="">Tanlang...</option>
                                    <option value="1">GOST ISO 9001</option>
                                </select>

                                <div class="help-block"></div>
                            </div>                </div>
                        <div class="col-sm-6" style="display: none;">
                            <div class="form-group field-resultlastdataform-0-standard_count">
                                <label class="control-label" for="resultlastdataform-0-standard_count">Xalqaro standartlarni joriy etish soni</label>
                                <input type="text" id="resultlastdataform-0-standard_count" class="form-control" name="ResultLastDataForm[0][standard_count]" placeholder="...">

                                    <div class="help-block"></div>
                            </div>                </div>
                    </div>
                </div>
            </div>
        </div>'

        $("<input />").attr("type", "hidden")
            .attr("name", "something")
            .attr("value", "something")
            .appendTo("#form");
        return true;
    });
</script>

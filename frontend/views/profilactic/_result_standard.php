<?php

use common\models\Nd;
use frontend\models\ResultLastDataForm;
use yii\helpers\ArrayHelper;
use wbraganca\dynamicform\DynamicFormWidget;

?>
<?php DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
    'widgetBody' => '.container-items', // required: css class selector
    'widgetItem' => '.item', // required: css class
    'limit' => 7, // the maximum times, an element can be cloned (default 999)
    'min' => 1, // 0 or 1 (default 1)
    'insertButton' => '.add-item', // css class
    'deleteButton' => '.remove-item', // css class
    'model' => $modelStandart[0],
    'formId' => 'dynamic-form',
    'formFields' => [
        'category',
        'help_count',
        'help_name',
        'standard_count',
        'standard_name'
    ],
]); ?>

<div class="container-items"><!-- widgetContainer -->
    <?php foreach ($modelStandart as $indexStandart => $stan): ?>
    <div class="item panel panel-default item-product"><!-- widgetBody -->
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
                    <?= $form->field($stan, "[{$indexStandart}]category")->label(false)->dropDownList(ResultLastDataForm::categoryList(), ['onchange' => 'handleChange(event)']) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($stan, "[{$indexStandart}]help_name")->dropDownList(
                        ArrayHelper::map(Nd::find()->all(), 'id', 'name'), [
                        'prompt' => 'Tanlang...'
                    ]) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($stan, "[{$indexStandart}]help_count")->textInput([
                        'maxlength' => true,
                        'placeholder' => '...'
                    ]) ?>
                </div>
                <div class="col-sm-6" style="display: none;">
                    <?= $form->field($stan, "[{$indexStandart}]standard_name")->dropDownList(
                        ArrayHelper::map(Nd::find()->all(), 'id', 'name'), [
                        'prompt' => 'Tanlang...'
                    ]) ?>
                </div>
                <div class="col-sm-6" style="display: none;">
                    <?= $form->field($stan, "[{$indexStandart}]standard_count")->textInput([
                        'maxlength' => true,
                        'placeholder' => '...'
                    ]) ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php DynamicFormWidget::end(); ?>
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
</script>

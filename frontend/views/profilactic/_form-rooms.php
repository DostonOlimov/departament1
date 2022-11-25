<?php

use common\models\Nd;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use wbraganca\dynamicform\DynamicFormWidget;

?>

<?php DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_inner',
    'widgetBody' => '.container-rooms',
    'widgetItem' => '.room-item',
    'limit' => 10,
    'min' => 1,
    'insertButton' => '.add-room',
    'deleteButton' => '.remove-room',
    'model' => $modelsRoom[0],
    'formId' => 'dynamic-form',
    'formFields' => [
        'nd_id',
        'description',
    ],
]); ?>
    <table class="table table-bordered" style="width: 35vw">
        <thead>
        </thead>
        <tbody class="container-rooms">
        <?php foreach ($modelsRoom as $indexRoom => $modelRoom): ?>
            <tr class="room-item">
                <td class="vcenter">
                    <div class="row">
                        <div class="col-sm-6">
                            <?= $form->field($modelRoom, "[{$indexHouse}][{$indexRoom}]nd_id")->label(false)->dropDownList(
                                ArrayHelper::map(Nd::find()->all(), 'id', 'name'), [
                                'prompt' => 'Tanlang...'
                            ]) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($modelRoom, "[{$indexHouse}][{$indexRoom}]description")->label(false)->textInput([
                                'maxlength' => true,
                                'placeholder' => '...'
                            ]) ?>
                        </div>
                    </div>
                </td>
                <td class="text-center vcenter" style="width: 90px;">
                    <button type="button" class="add-room btn btn-success btn-xs">
                        <span class="fa fa-plus"></span>
                    </button>
                    <button type="button" class="remove-room btn btn-danger btn-xs mt-3 ">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php DynamicFormWidget::end(); ?>
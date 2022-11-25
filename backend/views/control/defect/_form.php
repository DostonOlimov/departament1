<?php

use common\models\control\Defect;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\control\Defect */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="defect-form">

    <?php $form = ActiveForm::begin() ?>

    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'type')->checkboxList(Defect::typeList(), [
                'onclick' => 'typeChange(event)'
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'description')->textarea() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'compliance_quantity')->textInput(['placeholder' => "miqdori.."]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'compliance_cost')->textInput(['placeholder' => "summasi.."]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'tex_quantity')->textInput(['placeholder' => "miqdori.."]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'tex_cost')->textInput(['placeholder' => "summasi.."]) ?>
        </div>
    </div>

    <div class="col-12">
        <input type="submit" class="btn btn-info br-btn" value="Saqlash">
    </div>

    <?php ActiveForm::end() ?>

</div>
<script>

    function typeChange(e) {
        if (e.target.value == "4" && e.target.checked) {
            let inputs = document.querySelectorAll("#defect-type input:not(lastchild)")
            inputs.forEach(input => {
                    if (input.value != "4") {
                        input.setAttribute('disabled', 'disabled')
                    }
                }
            )
        }
        if (e.target.value == "4" && !e.target.checked) {
            let inputs = document.querySelectorAll("#defect-type input:not(lastchild)")
            inputs.forEach(input => {
                    if (input.value != "4") {
                        input.removeAttribute('disabled')
                    }
                }
            )
        }
        // console.log(e)
    }

</script>
<?php

/* @var $this yii\web\View */

/* @var $model ControlDefect */

use common\models\ControlDefect;
use frontend\widgets\Steps;
use yii\widgets\ActiveForm;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="page1-1 row ">


    <?= Steps::widget([
        'control_instruction_id' => $model->controlCompany->controlInstruction->id,
        'control_company_id' => $model->control_company_id,
    ]) ?>

    <?php $form = ActiveForm::begin() ?>

    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'type')->checkboxList(ControlDefect::typeList(), [
                'onclick' => 'typeChange(event)'
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'description')->textarea() ?>
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
            let inputs = document.querySelectorAll("#controldefect-type input:not(lastchild)")
            inputs.forEach(input => {
                    if (input.value != "4") {
                        input.setAttribute('disabled', 'disabled')
                    }
                }
            )
        }
        if (e.target.value == "4" && !e.target.checked) {
            let inputs = document.querySelectorAll("#controldefect-type input:not(lastchild)")
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
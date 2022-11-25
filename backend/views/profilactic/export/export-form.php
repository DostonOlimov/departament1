<?php

use kartik\daterange\DateRangePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Vaqt oralig\'ini tanlang';

?>

<?php ActiveForm::begin(); ?>

<div class="row-cols-md-5">

<?=
DateRangePicker::widget([
    'model'=>$model,
    'attribute'=>'begin_date',
    'convertFormat'=>true,
    'pluginOptions'=>[
        'timePicker'=>false,
        'timePickerIncrement'=>30,
//        'format'=>'Y-m-d',
        'locale'=>[
            'format'=>'Y/m/d',
            'separator'=>' - ',
        ],
    ]
])
?>

<div class="form-group mt-3">
    <?= Html::submitButton('yuklash', ['class' => 'btn btn-primary']) ?>
</div>

</div>
<?php ActiveForm::end(); ?>

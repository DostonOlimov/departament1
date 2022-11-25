<?php

use kartik\daterange\DateRangePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Vaqt oralig\'ini tanlang';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php ActiveForm::begin(); ?>

<div class="row">
    <div class="col-md-3">

    <?=
    DateRangePicker::widget([
        'model'=>$model,
        'attribute'=>'begin_date',
        'convertFormat'=>true,
        'pluginOptions'=>[
            'timePicker'=>false,
            'timePickerIncrement'=>30,
            'locale'=>[
                'format'=>'Y/m/d',
                'separator'=>' - ',
            ],
        ]
    ])
    ?>

    </div>

    <div class="col-md-3">
        <div class="form-group">
            <?= Html::submitButton('yuklab olish', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

</div>
<?php ActiveForm::end(); ?>

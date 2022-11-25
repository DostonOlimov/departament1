<?php

use common\models\User;
use frontend\widgets\Steps;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\control\InstructionUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="instruction-user-form">
    <div class="col-md-12">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'user_id')->widget(Select2::class, [
            'data' => ArrayHelper::map(User::find()->all(), 'id', 'username'),
            'language' => 'uz',
//            'options' => ['multiple' => true],
            'showToggleAll' => false,
        ])->label('name')

        ?>

        <div class="form-group">
            <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>

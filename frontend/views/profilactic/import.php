
<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
///* @var $model backend\models\user\Groups */

$this->title = 'Qo`shish';
$this->params['breadcrumbs'][] = ['label' => 'Ta`lim muassasalari', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="groups-create">

    <?php $form = \yii\widgets\ActiveForm::begin(['options'=> ['enctype'=> 'multipart/form-data']]); ?>

    <?= $form->field($model, 'username')->fileInput() ?>

    <?= Html::submitButton('Import', ['class' => 'btn btn-success']) ?>

    <?php \yii\widgets\ActiveForm::end(); ?>

</div>

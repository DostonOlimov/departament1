<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ControlInstruction */

$this->title = 'Create Control Instruction';
$this->params['breadcrumbs'][] = ['label' => 'Control Instructions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="control-instruction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

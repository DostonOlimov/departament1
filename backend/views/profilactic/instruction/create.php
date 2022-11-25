<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProInstruction */

$this->title = 'Create Pro Instruction';
$this->params['breadcrumbs'][] = ['label' => 'Pro Instructions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pro-instruction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

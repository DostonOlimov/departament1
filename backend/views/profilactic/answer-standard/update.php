<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProAnswerStandardCount */

$this->title = 'Update Pro Answer Standard Count: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Pro Answer Standard Counts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pro-answer-standard-count-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

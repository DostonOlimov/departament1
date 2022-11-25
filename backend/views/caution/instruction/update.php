<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\caution\Instruction */

$this->title = 'Yangilash: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Instructions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="instruction-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

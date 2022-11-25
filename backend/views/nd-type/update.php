<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\NdType */

$this->title = 'Yangilash: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Normativ hujjat toifalari', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="nd-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

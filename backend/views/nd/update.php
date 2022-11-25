<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Nd */

$this->title = 'Yangilash: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Normativ hujjatlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="nd-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

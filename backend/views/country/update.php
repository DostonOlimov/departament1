<?php

use shop\entities\Country;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model Country */

$this->title = 'Yangilash: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Inspektorlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="direction-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

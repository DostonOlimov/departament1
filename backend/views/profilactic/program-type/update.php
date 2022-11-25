<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProgramType */

$this->title = 'Dastur turini yangilash: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Dastur turi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="program-type-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

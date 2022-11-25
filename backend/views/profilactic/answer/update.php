<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\profilactic\Answer */

$this->title = 'Yangilash: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Korxonalar', 'url' => ['profilactic/profilactic/index']];
$this->params['breadcrumbs'][] = ['label' => $model->proCompany->name, 'url' => ['profilactic/profilactic/view', 'id' => $model->proCompany->proInstruction->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="pro-answer-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\profilactic\Instruction */

$this->title = 'Yangilash: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Korxonalar', 'url' => ['profilactic/profilactic/index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['profilactic/profilactic/view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="instruction-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

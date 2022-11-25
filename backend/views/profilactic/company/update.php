<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\profilactic\Company */

$this->title = 'Yangilash: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Korxonalar', 'url' => ['profilactic/profilactic/index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['profilactic/profilactic/view', 'id' => $model->pro_instruction_id]];
$this->params['breadcrumbs'][] = 'Xyus to\'g\'risida ma`lumot';
?>
<div class="pro-company-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

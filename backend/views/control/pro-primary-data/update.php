<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\control\ProPrimaryData */

$this->title = 'Update Pro Primary Data: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Korxonalar', 'url' => ['/control/control/index']];
$this->params['breadcrumbs'][] = ['label' => 'Narmativ hujjatlar', 'url' => ['index', 'control_primary_id' => $model->control_primary_id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="pro-primary-data-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

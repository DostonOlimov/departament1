<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\control\Measure */

$this->title = 'Yangilash: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Choralar', 'url' => ['/control/control/index']];
$this->params['breadcrumbs'][] = ['label' => $model->controlCompany->name, 'url' => ['/control/control/view', 'id' => $model->controlCompany->control_instruction_id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="measure-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

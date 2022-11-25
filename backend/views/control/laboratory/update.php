<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\control\Laboratory */

$this->title = 'Yangilash: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Korxonalar', 'url' => ['/control/control/index']];
$this->params['breadcrumbs'][] = ['label' => $model->controlCompany->name, 'url' => ['/control/control/view', 'id' => $model->controlCompany->control_instruction_id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="laboratory-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

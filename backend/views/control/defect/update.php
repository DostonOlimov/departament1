<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\control\Defect */

$this->title = 'Yangilash: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Korxonalar', 'url' => ['/control/control/index']];
$this->params['breadcrumbs'][] = ['label' => $model->controlCompany->name, 'url' => ['/control/control/view', 'id' => $model->controlCompany->control_instruction_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="defect-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

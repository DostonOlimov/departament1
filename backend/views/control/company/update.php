<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\control\Company */

$this->title = 'Yangilash: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Korxonalar', 'url' => ['/control/control/index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['/control/control/view', 'id' => $model->control_instruction_id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="company-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

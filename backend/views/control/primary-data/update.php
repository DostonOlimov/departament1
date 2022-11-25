<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\control\PrimaryData */

$this->title = 'Yangilash: ' . $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Primary Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['/control/control/view', 'id' => $model->controlCompany->control_instruction_id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="primary-data-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

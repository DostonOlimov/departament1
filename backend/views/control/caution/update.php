<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\control\Caution */

$this->title = 'Ko\'rsatmalarni yangilash: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ko\'rsatmalar', 'url' => ['index', 'company_id' => $model->control_company_id]];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="caution-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

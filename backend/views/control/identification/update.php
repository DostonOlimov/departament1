<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\control\Identification */

$this->title = 'Yangilash: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Korxonalar', 'url' => ['/control/control/index']];
$this->params['breadcrumbs'][] = ['label' => $model->controlCompany->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="identification-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

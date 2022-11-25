<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\control\ProductType */

$this->title = 'Mahsulot turini yangilash: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mahsulot turi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="product-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\control\ProductType */

$this->title = 'Mahsulot turi';
$this->params['breadcrumbs'][] = ['label' => 'Mahsulot turi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-type-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

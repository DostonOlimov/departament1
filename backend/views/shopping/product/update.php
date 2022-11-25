<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\shopping\Product */

$this->title = 'Yangilash: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mahsulot', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['/shopping/shopping/view', 'id' => $model->shoppingCompany->shopping_instruction_id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="product-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

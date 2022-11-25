<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\control\PrimaryProduct */

$this->title = $model->product_name . ': Maxsulotni yangilash';
$this->params['breadcrumbs'][] = ['label' => 'Maxsulotlar', 'url' => ['index', 'primary_data_id' => $model->control_primary_data_id]];
$this->params['breadcrumbs'][] = 'yangilash
';
?>
<div class="primary-product-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

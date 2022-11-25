<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\control\PrimaryProduct */

$this->title = 'Maxsulotni yaratish';
$this->params['breadcrumbs'][] = ['label' => 'Mahssulot', 'url' => ['index', 'primary_data_id' => $model->control_primary_data_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="primary-product-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

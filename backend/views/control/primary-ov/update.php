<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $primary_data_id */
/* @var $model common\models\control\PrimaryOv */

$this->title = 'O\'lchov vositasi';
$this->params['breadcrumbs'][] = ['label' => 'O\'v q\'shish', 'url' => ['index', 'primary_data_id' => $primary_data_id]];
$this->params['breadcrumbs'][] = 'O\'lchov vositasi';
?>
<div class="primary-ov-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

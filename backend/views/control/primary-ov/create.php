<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $control_primary_data_id */
/* @var $model common\models\control\PrimaryOv */

$this->title = 'O\'v q\'shish';
$this->params['breadcrumbs'][] = ['label' => 'O\'v q\'shish', 'url' => ['index', 'primary_data_id' => $control_primary_data_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="primary-ov-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

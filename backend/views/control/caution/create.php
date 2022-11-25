<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\control\Caution */

$this->title = 'Qo\'shish';
$this->params['breadcrumbs'][] = ['label' => 'Ko\'rsatma', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="caution-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

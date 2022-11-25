<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\NdType */

$this->title = 'Qo\'shish';
$this->params['breadcrumbs'][] = ['label' => 'Normativ hujjat toifalari', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nd-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

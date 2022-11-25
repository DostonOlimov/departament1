<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Nd */

$this->title = 'Qo\'shish';
$this->params['breadcrumbs'][] = ['label' => 'Normativ hujjatlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nd-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

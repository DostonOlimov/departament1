<?php

use shop\entities\Country;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model Country */

$this->title = 'Qo\'shish';
$this->params['breadcrumbs'][] = ['label' => 'Inspektorlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

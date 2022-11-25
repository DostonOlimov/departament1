<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\control\Laboratory */

$this->title = 'Create Laboratory';
$this->params['breadcrumbs'][] = ['label' => 'Laboratories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laboratory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

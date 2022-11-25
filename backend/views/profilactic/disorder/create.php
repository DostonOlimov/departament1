<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Disorder */

$this->title = 'Create Disorder';
$this->params['breadcrumbs'][] = ['label' => 'Disorders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disorder-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

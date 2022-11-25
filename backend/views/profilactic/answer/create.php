<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProAnswer */

$this->title = 'Create Pro Answer';
$this->params['breadcrumbs'][] = ['label' => 'Pro Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pro-answer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

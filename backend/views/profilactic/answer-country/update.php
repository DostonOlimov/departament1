<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProAnswerCountry */

$this->title = 'Yangilash: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Davlatlar', 'url' => ['index', 'answer_id' => $model->pro_answer_id]];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pro-answer-country-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

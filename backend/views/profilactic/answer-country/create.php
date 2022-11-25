<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProAnswerCountry */

$this->title = 'Davlat qo\'shish';
$this->params['breadcrumbs'][] = ['label' => 'Davlatlar', 'url' => ['index', 'answer_id' => $model->pro_answer_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pro-answer-country-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

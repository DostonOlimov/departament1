<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProAnswerStandardCount */

$this->title = 'Standart qo\'shish';
$this->params['breadcrumbs'][] = ['label' => 'Standartlar', 'url' => ['index', 'answer_id' => $model->pro_answer_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pro-answer-standard-count-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

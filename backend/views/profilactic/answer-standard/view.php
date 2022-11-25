<?php

use common\models\profilactic\AnswerStandardCount;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\profilactic\AnswerStandardCount */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Standartlar', 'url' => ['index', 'answer_id' => $model->pro_answer_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pro-answer-standard-count-view">

    <p>
        <?= Html::a('Yangilash', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('O\'chirish', ['delete', 'id' => $model->id, 'answer_id' => $model->pro_answer_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Haqiqatan ham bu elementni o‘chirib tashlamoqchimisiz?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
//            'pro_answer_id',
            'name',
            [
                'attribute' => 'type',
                'value' => function ($model) {
                    return $model->type ? AnswerStandardCount::typeList($model->type) : '';
                }
            ],
            [
                'attribute' => 'category',
                'value' => function ($model) {
                    return $model->category ? AnswerStandardCount::categoryList()[$model->category] : '';
                }
            ],
        ],
    ]) ?>

</div>

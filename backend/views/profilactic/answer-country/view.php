<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProAnswerCountry */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Davlatlar', 'url' => ['index', 'answer_id' => $model->pro_answer_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pro-answer-country-view">

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
            [
                'attribute' => 'country_id',
                'value' => function($model) {
                    return $model->country->name;
                }
            ],
            'import_export',
//            'pro_answer_id',
        ],
    ]) ?>

</div>

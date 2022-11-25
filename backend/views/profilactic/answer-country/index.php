<?php

use common\models\profilactic\Answer;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\profilactic\AnswerCountrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$company = Answer::findOne($answer_id)->proCompany;
$this->title = 'Davlatlar';
$this->params['breadcrumbs'][] = ['label' => $company->name, 'url' => ['profilactic/profilactic/view', 'id' => $company->proInstruction->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pro-answer-country-index">

    <p>
        <?= Html::a('Qo\'shish', ['create', 'answer_id' => $answer_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'country_id',
                'value' => function ($model) {
                    return $model->country->name;
                }
            ],
            'import_export',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
            ],
        ],
    ]); ?>


</div>

<?php

use common\models\profilactic\Answer;
use common\models\profilactic\AnswerStandardCount;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\profilactic\AnswerStandardCountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$company = Answer::findOne($answer_id)->proCompany;
$this->title = 'Standartlar';
$this->params['breadcrumbs'][] = ['label' => $company->name, 'url' => ['profilactic/profilactic/view', 'id' => $company->proInstruction->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pro-answer-standard-count-index">

    <p>
        <?= Html::a('Qo\'shish', ['create', 'answer_id' => $answer_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'pro_answer_id',
            'name',
            [
                'attribute' => 'type',
                'value' => function ($model) {
                    return AnswerStandardCount::typeList($model->type);
                }
            ],
            [
                'attribute' => 'category',
                'value' => function ($model) {
                    return $model->category ? AnswerStandardCount::categoryList()[$model->category] : '';
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

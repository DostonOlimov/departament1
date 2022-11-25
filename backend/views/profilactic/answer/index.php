<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProAnswerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pro Answers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pro-answer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pro Answer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'pro_company_id',
            'product_name',
            'internation_standard',
            'product_quality',
            //'employee',
            //'smk',
            //'international_certificate',
            //'level',
            //'import_export',
            //'import_export_product',
            //'lab_check',
            //'created_by',
            //'updated_by',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

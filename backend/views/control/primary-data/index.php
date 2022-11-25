<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\control\PrimaryDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Primary Datas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="primary-data-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Primary Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'control_company_id',
            'residue_quantity',
            'residue_amount',
            'potency',
            //'year_quantity',
            //'year_amount',
            //'created_by',
            //'updated_by',
            //'created_at',
            //'updated_at',
            //'laboratory',
            //'smt',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

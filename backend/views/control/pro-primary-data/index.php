<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $control_primary_id */
/* @var $searchModel common\models\ProPrimaryDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Narmativ hujjatlar';
$this->params['breadcrumbs'][] = ['label' => 'Korxonalar', 'url' => ['/control/control/index']];
$this->params['breadcrumbs'][] = ['label' => 'Mahsulot', 'url' => ['/control/primary-product/view', 'id' => $control_primary_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pro-primary-data-index">

    <p>
        <?= Html::a('hujjat Qo\'shish', ['create', 'control_primary_id' => $control_primary_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'control_primary_id',
            'product_name',
            'product_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

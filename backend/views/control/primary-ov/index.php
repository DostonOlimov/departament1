<?php

use common\models\control\PrimaryOv;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $primary_data_id */
/* @var $searchModel common\models\PrimaryOvSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'O\'v turlari';
$this->params['breadcrumbs'][] = ['label' => 'Korxonalar', 'url' => ['/control/control/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="primary-ov-index">

    <p>
        <?= Html::a('O\'v qo\'shish', ['create', 'control_primary_data_id' => $primary_data_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'control_primary_data_id',
            [
                'attribute' => 'type',
                'value' => function(PrimaryOv $model){
                    return $model::getType($model->type);
                }
            ],
            'measurement',
            'compared',
            //'invalid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

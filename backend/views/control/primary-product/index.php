<?php

use common\models\control\PrimaryProduct;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $primary_data_id */
/* @var $searchModel common\models\PrimaryProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Maxsulotlar';
$this->params['breadcrumbs'][] = ['label' => 'Korxonalar', 'url' => ['/control/control/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="primary-product-index">

    <p>
        <?= Html::a('Maxsulot qo\'shish', ['create', 'primary_data_id' => $primary_data_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'control_primary_data_id',
            'nd',
            'nd_type',
            'number_blank',
            //'number_reestr',
            //'date_from',
            //'date_to',
            //'product_type_id',
            //'product_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

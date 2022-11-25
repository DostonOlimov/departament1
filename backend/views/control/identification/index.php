<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\control\IdentificationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Identifikatsiya';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="identification-index">

    <p>
        <?= Html::a('Qo\'shish', ['create', 'company_id' => $company_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'control_company_id',
            'file',
            'identification',
//            'created_by',
            //'updated_by',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

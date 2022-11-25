<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProgramTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dastur turi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-type-index">
    <p>
        <?= Html::a('Qo\'shish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            'name',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

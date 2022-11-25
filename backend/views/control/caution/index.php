<?php

use common\models\control\Caution;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\control\CautionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ko\'rsatmalar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="caution-index">

    <p>
        <?= Html::a('Qo\'shish', ['create', 'company_id' => $company_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'control_company_id',
            [
                'attribute' => 'caution',
                'value' => function (Caution $model) {
                    return ($model->caution || $model->caution === 0) ? Caution::getType($model->caution) : '';
                },
                'format' => 'raw'
            ],
            'caution_date',
            'caution_number',
            //'file',
            //'description',
            //'created_by',
            //'updated_by',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

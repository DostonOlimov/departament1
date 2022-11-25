<?php

/* @var $this yii\web\View */

/* @var $model PrimaryData */

use common\models\control\PrimaryData;
use common\models\control\PrimaryOv;
use common\models\control\PrimaryProduct;
use common\models\control\ProPrimaryData;
use frontend\widgets\Steps;
use yii\grid\GridView;
use yii\widgets\DetailView;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="page1-1 row">

    <?= Steps::widget([
        'control_instruction_id' => $model->controlCompany->control_instruction_id,
        'control_company_id' => $model->control_company_id,
    ]) ?>

    <div class="col-6">
        <h3>O'lchov vositalari</h3>
        <?php
        //\yii\helpers\VarDumper::dump(PrimaryOv::findOne(['control_primary_data_id' => $model->id]),12,true);die;
        if (PrimaryOv::findOne(['control_primary_data_id' => $model->id])) {
            echo GridView::widget([
                'dataProvider' => $dataOv,
//                    'filterModel' => $searchOv,
                'headerRowOptions' => ['style' => 'background-color: #198754;'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'measurement',
                    'compared',
                    'invalid',
                    [
                        'attribute' => 'type',
                        'value' => function (PrimaryOv $model) {
                            return PrimaryOv::getType($model->type);
                        }
                    ]
                ],
            ]);
        }
        ?>

        <hr>
        <?php
        if (PrimaryProduct::findOne(['control_primary_data_id' => $model->id])) {
            echo "<h3>Mahsulot</h3>";
            echo GridView::widget([
                'dataProvider' => $dataProduct,
//                    'filterModel' => $searchProduct,
                'headerRowOptions' => ['style' => 'background-color: #198754;'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'product_type_id',
                    'number_blank',
                    'number_reestr',
                    'product_name',
                    'nd_type',
                    'date_from',
                    'date_to',
                    [
                        'label' => 'Normativ hujjat nomi sanasi',
                        'value' => function($model) {
                            $data = ProPrimaryData::find()->where(['control_primary_id' => $model->id])->all();
                            $result = '';
                            foreach ($data as $da) {
                                $result .= '<span>' . $da->product_name . '(' . $da-> product_date . ')' . '</span><br>';
                            }
                            return $result;
                        },
                        'format' => 'raw'
                    ]
                ],
            ]);
        }
        ?>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'residue_quantity',
                'residue_amount',
                'year_quantity',
                'year_amount',
                'potency',
            ],
        ]) ?>
    </div>

</div>

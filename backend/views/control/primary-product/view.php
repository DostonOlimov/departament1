<?php

use common\models\control\PrimaryProduct;
use common\models\control\ProductType;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\control\PrimaryProduct */

$this->title = $model->product_name ? $model->product_name : '';
$this->params['breadcrumbs'][] = ['label' => 'Maxsulotlar', 'url' => ['index', 'primary_data_id' => $model->control_primary_data_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="primary-product-view">

    <p>
        <?= Html::a('Yangilash', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Narmativ hujjat', ['/control/pro-primary-data', 'control_primary_id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('O\'chirish', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Siz bu maxsulotni o\'chirmoqchimisiz?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
//            'control_primary_data_id',
//            'nd',
            'nd_type',
            'number_blank',
            'number_reestr',
            'date_from',
            'date_to',
            [
                'label' => 'Mahsulot turi',
                'value' => function(PrimaryProduct $model){
                    return ProductType::find()->select('name')->where(['id' => $model->product_type_id])->one()->name;
                }
            ],
            'product_name',
        ],
    ]) ?>

</div>

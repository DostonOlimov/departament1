<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\control\ProPrimaryData */

$this->title = $model->product_name;
$this->params['breadcrumbs'][] = ['label' => 'Korxonalar', 'url' => ['/control/control/index']];

$this->params['breadcrumbs'][] = ['label' => 'Narmativ hujjatlar', 'url' => ['index', 'control_primary_id' => $model->control_primary_id]];
//$this->params['breadcrumbs'][] = ['label' => 'Narmativ hujjatlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pro-primary-data-view">

    <p>
        <?= Html::a('Yangilash', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('O\'chirish', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Siz bu hujjatni o\'chirmoqchimisiz?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
//            'control_primary_id',
            'product_name',
            'product_date',
        ],
    ]) ?>

</div>

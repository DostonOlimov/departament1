<?php

use common\models\control\PrimaryOv;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\control\PrimaryOv */

$this->title = 'O\'lchov vositasi';
$this->params['breadcrumbs'][] = ['label' => 'Korxonalar', 'url' => ['/control/control/index']];
$this->params['breadcrumbs'][] = ['label' => 'Primary Ovs', 'url' => ['index', 'primary_data_id' => $model->control_primary_data_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="primary-ov-view">

    <p>
        <?= Html::a('Yangilash', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('O\'chirish', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Siz rostdan ham ushbu elementni o`chirmoqchimisiz?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
//            'control_primary_data_id',
//            'type',
            [
                'label' => 'O\'v turlari',
                'value' => function(PrimaryOv $model){
                    return $model::getType($model->type);
                }
            ],
            'measurement',
            'compared',
            'invalid',
        ],
    ]) ?>

</div>

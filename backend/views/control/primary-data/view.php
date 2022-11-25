<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\control\PrimaryData */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Primary Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="primary-data-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'control_company_id',
            'residue_quantity',
            'residue_amount',
            'potency',
            'year_quantity',
            'year_amount',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
            'laboratory',
            'smt',
        ],
    ]) ?>

</div>

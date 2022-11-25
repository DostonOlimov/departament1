<?php

use common\models\control\Caution;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\control\Caution */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ko\'rsatmalar', 'url' => ['index', 'company_id' => $model->control_company_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="caution-view">

    <p>
        <?= Html::a('Yangilash', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('O\'chirish', ['delete', 'id' => $model->id], [
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
            [
                'attribute' => 'caution',
                'value' => function (Caution $model) {
                    return ($model->caution || $model->caution === 0) ? Caution::getType($model->caution) : '';
                },
                'format' => 'raw'
            ],
            'caution_date',
            'caution_number',
            [
                'attribute' => 'file',
                'value' => function (Caution $model) {
                    $model->s_file = $model->file;
                    return $model->s_file ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('s_file') . '" download>Yuklash<a/>' : '';

                },
                'format' => 'raw'
            ],
            'description:text',
        ],
    ]) ?>

</div>

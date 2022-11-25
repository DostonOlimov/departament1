<?php

use common\models\control\Laboratory;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\control\Laboratory */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Laboratories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="laboratory-view">

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
            [
                'attribute' => 'dalolatnoma',
                'value' => function (Laboratory $model) {
                    return $model->dalolatnoma ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('dalolatnoma') . '" download>Yuklash<a/>' : '';
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'bayonnoma',
                'value' => function (Laboratory $model) {
                    return $model->bayonnoma ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('bayonnoma') . '" download>Yuklash<a/>' : '';
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'out_bayonnoma',
                'value' => function (Laboratory $model) {
                    return $model->out_bayonnoma ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('out_bayonnoma') . '" download>Yuklash<a/>' : '';
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'out_dalolatnoma',
                'value' => function (Laboratory $model) {
                    return $model->out_dalolatnoma ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('out_dalolatnoma') . '" download>Yuklash<a/>' : '';
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'finish_dalolatnoma',
                'value' => function (Laboratory $model) {
                    return $model->finish_dalolatnoma ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('finish_dalolatnoma') . '" download>Yuklash</a>' : '';
                },
                'format' => 'raw'
            ],
        ],
    ]) ?>

</div>

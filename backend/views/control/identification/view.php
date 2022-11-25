<?php

use common\models\control\Identification;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\control\Identification */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Identifikatsiya', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="identification-view">

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
                'attribute' => 'file',
                'value' => function (Identification $model) {
//                    $model->img = $model->file;
                    return $model->file ? '<a class="btn btn-info" target="_blank" href="' . $model->getUploadedFileUrl('file') . '" >Yuklash</a>' : '';
                },
                'format' => 'raw'
            ],
            'identification:text',
        ],
    ]) ?>

</div>

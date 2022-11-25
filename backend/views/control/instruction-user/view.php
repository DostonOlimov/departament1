<?php

use common\models\control\InstructionUser;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\control\InstructionUser */

$in_id = InstructionUser::find()
    ->select('instruction_id')
    ->where(['id' => $model->id])
    ->one();

$this->title = 'Foydalanuvchi';
$this->params['breadcrumbs'][] = ['label' => 'Korxonalar', 'url' => ['/control/control/index']];
$this->params['breadcrumbs'][] = ['label' => 'Foydalanuvchilar', 'url' => ['index', 'instruction_id' => $in_id->instruction_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="instruction-user-view">

    <p>
        <?= Html::a('yangilash', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('O\'chirish', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Siz bu foydalanuvchini o\'chirmoqchimisiz?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label' => 'Foydalanuvchilar',
                'value' => function(InstructionUser $model){
                    return $model->user->username;
                }
            ]
        ],
    ]) ?>

</div>

<?php

use common\models\control\InstructionUser;
use common\models\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $instruction_id */
/* @var $searchModel common\models\control\InstructionUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Foydalanuvchilar';
$this->params['breadcrumbs'][] = ['label' => 'Korxonalar', 'url' => ['/control/control/index']];
$this->params['breadcrumbs'][] = ['label' => 'davlat nazorati', 'url' => ['/control/control/view', 'id' => $instruction_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="instruction-user-index">

    <p>
        <?= Html::a('Qo\'shish', ['create', 'instruction_id' => $instruction_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Foydalonuvchilar',
                'value' => function(InstructionUser $model){
                     return $model->user->username;
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

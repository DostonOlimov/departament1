<?php

use common\models\profilactic\Answer;
use common\models\profilactic\Company;
use common\models\profilactic\Instruction;
use frontend\models\StatusHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel common\models\profilactic\InstructionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Korxonalar';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .pagination li a {
        padding: 2px 5px;
    }
    .pagination li.active {
        background-color: #1AB475   ;
    }
    .pagination li a {
        color: black;
    }
    .pagination li a:hover {
        background-color: grey;
    }
</style>

<div class="company-index m-5 pb-5">

    <p>
        <?= Html::a('Qo\'shish', ['/profilactic/instruction'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'headerRowOptions' => ['style' => 'background-color: #0072B5'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Hudud',
                'value' => function ($model) {
                    $company = Company::findOne(['pro_instruction_id' => $model->id]);
                    return $company ? $company->region->name : '';
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttonOptions' => [
                    'class' => 'text-primary'
                ],
                /*'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('', $url);
                    },
                ],*/
                'urlCreator' => function ($action, $searchmodel, $key, $index) {
                    if ($action === 'view') {
                        $url = Url::to(['profilactic/ins-view', 'id' => $searchmodel->id]);
                        return $url;
                    }
                }
            ],
            [
                'label' => 'Xyus nomi',
                'value' => function ($model) {
                    $company = Company::findOne(['pro_instruction_id' => $model->id]);
                    if ($company) {
                        return Html::a($company->name, ['/profilactic/ins-view', 'id' => $model->id], ['class' => 'text-primary']);
                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Xyus inn',
                'value' => function ($model) {
                    $company = Company::findOne(['pro_instruction_id' => $model->id]);
                    if ($company) {
                        return Html::a($company->inn, ['/profilactic/ins-view', 'id' => $model->id], ['class' => 'text-primary']);
                    }
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Xyus yuridik manzili',
                'value' => function ($model) {
                    $company = Company::findOne(['pro_instruction_id' => $model->id]);
                    if ($company) {
                        return $company->address;
                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Asos',
                'value' => function ($model) {
                    return Instruction::getType($model->base);
                }
            ],
            [
                'label' => 'Status',
                'value' => function ($model) {
                    return StatusHelper::getLabelForPro($model->general_status);

                },
                'format' => 'raw'
            ],
            //'created_by',
            //'updated_by',
            //'created_at',
            //'updated_at',

//            'phone',
        ],
    ]); ?>


</div>

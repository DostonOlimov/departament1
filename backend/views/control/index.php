<?php

use common\models\control\Company;
use common\models\control\Instruction;
use common\models\control\Measure;
use common\models\Region;
use common\models\User;
use frontend\models\StatusHelper;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\control\InstructionSearch */
/* @var $dataProvider yii\data\ActiveDataprovider */

$this->title = 'Korxonalar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <p>
        <?= Html::a('Export', ['/control/control/export-form'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'region_id',
                'label' => 'Hudud',
                'value' => function (Instruction $model) {
                    return $model->controlCompany ? $model->controlCompany->region->name : '';
                },
                'filter' => Html::activeDropDownList($searchModel, 'region_id', ArrayHelper::map(Region::find()->all(), 'id', 'name'), ['class' => 'form-control', 'prompt' => '- - -'])
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
                        $url = Url::to(['view', 'id' => $searchmodel->id]);
                        return $url;
                    }
                }
            ],
            [
                'attribute' => 'name',
                'label' => 'XYUS nomi',
                'value' => function (Instruction $model) {
                    return $model->controlCompany ? $model->controlCompany->name : '';
                },
                'filter' => Html::activeInput('text',$searchModel, 'name', ['class' => 'form-control']),
                'format' => 'raw',
            ],
            [
                'attribute' => 'inn',
                'label' => 'XYUS STIR',
                'value' => function (Instruction $model) {
                    return $model->controlCompany ? $model->controlCompany->inn : '';
                },
                'filter' => Html::activeInput('text',$searchModel, 'inn', ['class' => 'form-control']),
                'format' => 'raw',
            ],
            [
                'label' => 'XYUS yuridik manzili',
                'value' => function (Instruction $model) {
                    return $model->controlCompany ? $model->controlCompany->address : '';
                },
                'format' => 'raw',
            ],
            [
                'label' => 'XYUS faoliyat turi',
                'value' => function ($model) {
                    return $model->controlCompany ? $model->controlCompany->type : '';
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'base',
                'value' => function ($model) {
                    return Instruction::getType($model->base);
                },
                'filter' => Html::activeDropDownList($searchModel, 'base', Instruction::getType(), ['class' => 'form-control', 'prompt' => '- - -'])
            ],
            [
                'attribute' => 'created_by',
                'label' => 'Mutaxassis',
                'value' => function ($model) {
                    return $model->createdBy->username;
                },
                'filter' => Html::activeDropDownList($searchModel, 'created_by', ArrayHelper::map(User::find()->all(), 'id', 'username'), ['class' => 'form-control', 'prompt' => '- - -'])
            ],
            [
                'label' => 'Status',
                'value' => function ($model) {
                    return StatusHelper::getLabel($model->general_status);
                },
                'format' => 'raw'
            ],
        ],
    ]); ?>


</div>

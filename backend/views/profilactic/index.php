<?php

use common\models\profilactic\Answer;
use common\models\profilactic\Company;
use common\models\profilactic\Instruction;
use common\models\profilactic\Result;
use common\models\Region;
use common\models\User;
use frontend\models\StatusHelper;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\profilactic\InstructionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Korxonalar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">
<p>
            <?= Html::a('Export', ['/profilactic/profilactic/export-form'], ['class' => 'btn btn-primary']) ?>
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
                    return $model->company ? $model->company->region->name : '';
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
                'label' => 'Xyus nomi',
                'value' => function (Instruction $model) {
                    return $model->company ? $model->company->name : '';
                },
                'filter' => Html::activeInput('text',$searchModel, 'name', ['class' => 'form-control']),
                'format' => 'raw',
            ],
            [
                'attribute' => 'inn',
                'label' => 'Xyus inn',
                'value' => function (Instruction $model) {
                    return $model->company ? $model->company->inn : '';
                },
                'filter' => Html::activeInput('text',$searchModel, 'inn', ['class' => 'form-control']),
                'format' => 'raw',
            ],
            [
                'label' => 'Xyus yuridik manzili',
                'value' => function (Instruction $model) {
                    return $model->company ? $model->company->address : '';
                },
                'format' => 'raw',
            ],
//            [
//                'label' => 'Xyus faoliyat turi',
//                'value' => function (Instruction $model) {
//                    return $model->company ? $model->company->type : '';
//                },
//                'format' => 'raw',
//            ],
            [
                'attribute' => 'base',
                'label' => 'Asos',
                'value' => function ($model) {
                    return Instruction::getType($model->base);
                },
                'filter' => Html::activeDropDownList($searchModel, 'base', Instruction::getType(), ['class' => 'form-control', 'prompt' => '- - -'])
            ],
            [
                'attribute' => 'created_by',
                'label' => 'Mutaxasis',
                'value' => function (Instruction $model) {
                    return $model->createdBy ? $model->createdBy->username : '';
                },
                'filter' => Html::activeDropDownList($searchModel, 'created_by', ArrayHelper::map(User::find()->all(), 'id', 'username'), ['class' => 'form-control', 'prompt' => '- - -'])
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

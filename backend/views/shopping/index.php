<?php

use common\models\Region;
use common\models\shopping\Company;
use common\models\shopping\Instruction;
use common\models\shopping\Product;
use common\models\User;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\shopping\InstructionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Korxonalar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

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
                'value' => function ($model) {
                    $company = Company::findOne(['shopping_instruction_id' => $model->id]);
                    if ($company) {
                        return $company->address;
                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
            ],
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
                'value' => function ($model) {
                    return $model->createdBy->username;
                },
                'filter' => Html::activeDropDownList($searchModel, 'created_by', ArrayHelper::map(User::find()->all(), 'id', 'username'), ['class' => 'form-control', 'prompt' => '- - -'])
            ],
            [
                'label' => 'Status',
                'value' => function ($model) {
                    $company = Company::findOne(['shopping_instruction_id' => $model->id]);
                    if ($company) {
                        if (Product::findOne(['shopping_company_id' => $company->id])) {
                            return '<label style="color: blue">Bajarildi</labelsty>';
                        } else {
                            return '<label style="color: orange">Jarayonda</labelsty>';
                        }
                    } else {
                        return '<label style="color: orange">Jarayonda</labelsty>';
                    }
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

<?php

use common\models\ControlCompany;
use common\models\ControlInstruction;
use common\models\ControlMeasure;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ControlInstructionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Korxonalar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index m-5">

    <p>
        <?= Html::a('Qo\'shish', ['/site/instruction'], ['class' => 'btn btn-success'])  ?>
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
                    $company = ControlCompany::findOne(['control_instruction_id' => $model->id]);
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
                        $url = Url::to(['site/instruction-view', 'id' => $searchmodel->id]);
                        return $url;
                    }
                }
            ],
            [
                'label' => 'Xyus nomi',
                'value' => function ($model) {
                    $company = ControlCompany::findOne(['control_instruction_id' => $model->id]);
                    if ($company) {
                        return Html::a($company->name, ['/site/instruction-view', 'id' => $model->id], ['class' => 'text-primary']);
                    }
                    return '';
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Xyus inn',
                'value' => function ($model) {
                    $company = ControlCompany::findOne(['control_instruction_id' => $model->id]);
                    if ($company) {
                        return Html::a($company->inn, ['/site/instruction-view', 'id' => $model->id], ['class' => 'text-primary']);
                    }
                    return '';
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Xyus yuridik manzili',
                'value' => function ($model) {
                    $company = ControlCompany::findOne(['control_instruction_id' => $model->id]);
                    if ($company) {
                        return $company->address;
                    }
                    return '';
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Xyus faoliyat turi',
                'value' => function ($model) {
                    $company = ControlCompany::findOne(['control_instruction_id' => $model->id]);
                    if ($company) {
                        return $company->type;
                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Mahsulot nomi',
                'value' => function ($model) {
                    return '';
                }
            ],
            [
                'label' => 'Asos',
                'value' => function (ControlInstruction $model) {
                    return ControlInstruction::getType($model->base);
                }
            ],
            [
                'label' => 'Mutaxasis',
                'value' => function ($model) {
                    return $model->createdBy->username;
                }
            ],
            [
                'label' => 'Status',
                'value' => function ($model) {
                    $company = ControlCompany::findOne(['control_instruction_id' => $model->id]);
                    if ($company) {
                        if (ControlMeasure::findOne(['control_company_id' => $company->id])) {
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

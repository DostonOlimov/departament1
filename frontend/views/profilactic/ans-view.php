<?php

/* @var $this yii\web\View */

/* @var $model Answer */

use common\models\profilactic\Answer;
use common\models\profilactic\AnswerCountry;
use common\models\profilactic\AnswerStandardCount;
use common\models\profilactic\Company;
use frontend\widgets\StepsProfilactic;
use yii\grid\GridView;
use yii\widgets\DetailView;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;

$proCompany = Company::findOne($model->pro_company_id)
?>


<div class="page1-1 row ">

    <?= StepsProfilactic::widget([
        'pro_instruction_id' => $proCompany->pro_instruction_id,
        'pro_company_id' => $model->pro_company_id,
    ]) ?>

    <div class="col-6">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'attribute' => 'field_name',
                    'value' => function (Answer $model) {
                        return ($model->field_name || $model->field_name === 0) ? Answer::typeList($model->field_name) : '';
                    }
                ],
                'product_name',
                'internation_standard',
                'product_quality',
                'employee',
                'smk',
                'international_certificate',
                'import_product',
                'export_product',
                [
                    'label' => 'Davlatlar',
                    'value' => function (Answer $model) {
                        $result = '';
                        $countries = AnswerCountry::find()->where(['pro_answer_id' => $model->id])->all();
                        if ($countries) {
                            foreach ($countries as $country) {
                                $result .= '<label>' . $country->country->name . ' ' . '<span class="badge bg-secondary">' . $country->import_export . '</span></label><br>';
                            }
                            return $result;
                        }
                    },
                    'format' => 'raw',
                ],
                'organization_name',
                'reestr_number',
                'validity_period',
                'all_instruments',
                'expired_instruments',
                'not_expired_instruments',
                [
                    'attribute' => 'lab_check',
                    'value' => function (Answer $model) {
                        $result = '';
                        if ($model->lab_check) {
                            foreach (explode(',', $model->lab_check) as $lab) {
                                $result .= '<label>' . Answer::labList($lab) . '</label><br>';
                            }
                            return $result;
                        }
                    },
                    'format' => 'raw',
                ],
               // 'overall_comment',
            ],
        ]) ?>
        <hr>
        <h3>Foydalanadigan standartlari soni belgilanishi</h3>
        <?php
        //\yii\helpers\VarDumper::dump(PrimaryOv::findOne(['control_primary_data_id' => $model->id]),12,true);die;
        if (AnswerStandardCount::findOne(['pro_answer_id' => $model->id])) {
            echo GridView::widget([
                'dataProvider' => $dataProvider,
//                    'filterModel' => $searchOv,
                'headerRowOptions' => ['style' => 'background-color: #198754;'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'name',
                    [
                        'attribute' => 'category',
                        'value' => function ($model) {
                            return $model->category ? AnswerStandardCount::categoryList()[$model->category] : '';
                        }
                    ],
                    [
                        'attribute' => 'type',
                        'value' => function (AnswerStandardCount $model) {
                            return ($model->type || $model->type === 0) ? AnswerStandardCount::typeList($model->type) : '';
                        }
                    ],
                ],
            ]);
        }
        ?>
    </div>

</div>

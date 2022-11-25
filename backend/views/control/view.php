<?php

use common\models\control\Caution;
use common\models\control\Company;
use common\models\control\Defect;
use common\models\control\Identification;
use common\models\control\Instruction;
use common\models\control\InstructionUser;
use common\models\control\Laboratory;
use common\models\control\Measure;
use common\models\control\PrimaryData;
use common\models\control\PrimaryOv;
use common\models\control\PrimaryProduct;
use frontend\models\LaboratoryHelper;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\control\Instruction */

$this->title = 'Davlat nazorati o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = ['label' => 'Korxonalar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="instruction-view">

    <p>
        <?= Html::a('Yangilash', ['/control/instruction/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Foydalanuvchilar', ['/control/instruction-user/index', 'instruction_id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
            if ($model->general_status == Instruction::GENERAL_STATUS_SEND) {
                echo Html::a('Tasdiqlash', ['/control/control/done', 'id' => $model->id], ['class' => 'btn btn-warning']);
            }
        ?>

        <?= Html::a('Hamma ma`lumotni o\'chirish', ['/control/instruction/delete', 'id' => $model->id], [
            'class' => 'btn btn-danger float-right',
            'data' => [
                'confirm' => 'Haqiqatan ham bu elementni o‘chirmoqchimisiz?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            [
                'attribute' => 'base',
                'value' => function ($model) {
                    return Instruction::getType($model->base);
                }
            ],
            'letter_date:date',
            'letter_number',
            'command_date:date',
            'command_number',
            'checkup_begin_date:date',
            'checkup_finish_date:date',
            [
                'label' => 'Inspektorlar',
                'value' => function ($model) {
                    $users = InstructionUser::find()->where(['instruction_id' => $model->id])->all();
                    $result = '';
                    foreach ($users as $user) {
                        $result .= '<span class="text-secondary">' . $user->user->username . '</span><br>';
                    }
                    return $result;
                },
                'format' => 'raw'
            ],
        ],
    ]) ?>

</div>


<?php
$company = Company::findOne(['control_instruction_id' => $model->id]);
if ($company) { ?>
    <hr>
    <h2>Xyus to'g'risida ma`lumot</h2>
    <div class="company-view">
        <p>
            <?= Html::a('Yangilash', ['/control/company/update', 'id' => $company->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Ko\'rsatmalar', ['/control/caution/index', 'company_id' => $company->id], ['class' => 'btn btn-secondary float-right']) ?>
            <?= Html::a('Identifikatsiya', ['/control/identification/index', 'company_id' => $company->id], ['class' => 'btn btn-secondary float-right mr-2']) ?>
        </p>
        <?= DetailView::widget([
            'model' => $company,
            'attributes' => [
                'name',
                'inn',
                'type',
                'soogu',
                [
                    'label' => 'Hudud',
                    'value' => function (Company $model) {
                        return $model->region->name;
                    }
                ],
                [
                    'attribute' => 'phone',
                    'value' => function (Company $model) {
                        return $model->phoneNumber;
                    },
                ],
                'address',
                [
                    'label' => 'Mutaxasis',
                    'value' => function (Company $model) {
                        return $model->createdBy->username;
                    },
                ],
            ],
        ]) ?>
    </div>

    <?php
    $primaryData = PrimaryData::findOne(['control_company_id' => $company->id]);
    if ($primaryData) { ?>
        <hr>
        <h2>Birlamchi ma`lumotlar</h2>
        <div class="company-view">
            <p>
                <?= Html::a('Yangilash', ['/control/primary-data/update', 'id' => $primaryData->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Mahsulotlar', ['/control/primary-product/index', 'primary_data_id' => $primaryData->id], ['class' => 'btn btn-info']) ?>
                <?= Html::a('O\'lchov vositalari', ['/control/primary-ov/index', 'primary_data_id' => $primaryData->id], ['class' => 'btn btn-info']) ?>
            </p>
            <?= DetailView::widget([
                'model' => $primaryData,
                'attributes' => [
                    'residue_quantity',
                    'residue_amount',
                    'year_quantity',
                    'year_amount',
                    'potency',

                ],
            ]) ?>
        </div>
    <?php }

    $laboratory = Laboratory::findOne(['control_company_id' => $company->id]);
    if ($laboratory) { ?>
        <hr>
        <h2>Birlamchi ma`lumotlar</h2>
        <div class="company-view">
            <p>
                <?= Html::a('Yangilash', ['/control/laboratory/update', 'id' => $laboratory->id], ['class' => 'btn btn-primary']) ?>
            </p>
            <?= DetailView::widget([
                'model' => $laboratory,
                'attributes' => [
                    [
                        'attribute' => 'dalolatnoma',
                        'value' => function (Laboratory $model) {
                            return $model->dalolatnoma ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('dalolatnoma') . '" download>Yuklash<a/>' : LaboratoryHelper::getForm($model->id, 'dalolatnoma');
                        },
                        'format' => 'raw'
                    ],
                    [
                        'attribute' => 'bayonnoma',
                        'value' => function (Laboratory $model) {
                            return $model->bayonnoma ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('bayonnoma') . '" download>Yuklash<a/>' : LaboratoryHelper::getForm($model->id, 'bayonnoma');
                        },
                        'format' => 'raw'
                    ],
                    [
                        'attribute' => 'out_bayonnoma',
                        'value' => function (Laboratory $model) {
                            return $model->out_bayonnoma ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('out_bayonnoma') . '" download>Yuklash<a/>' : LaboratoryHelper::getForm($model->id, 'out_bayonnoma');
                        },
                        'format' => 'raw'
                    ],
                    [
                        'attribute' => 'out_dalolatnoma',
                        'value' => function (Laboratory $model) {
                            return $model->out_dalolatnoma ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('out_dalolatnoma') . '" download>Yuklash<a/>' : LaboratoryHelper::getForm($model->id, 'out_dalolatnoma');
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
    <?php }

    $defect = Defect::findOne(['control_company_id' => $company->id]);
    if ($defect) { ?>
        <hr>
        <h2>Aniqlangan kamchiliklar</h2>
        <div class="result-view">
            <p>
                <?= Html::a('Yangilash', ['/control/defect/update', 'id' => $defect->id], ['class' => 'btn btn-primary']) ?>
            </p>
            <?= DetailView::widget([
                'model' => $defect,
                'attributes' => [
//            'id',
                    [
                        'attribute' => 'type',
                        'value' => function (Defect $model) {
                            $result = '';
                            preg_match_all('!\d+!', $model->type, $matches);
                            foreach ($matches[0] as $type) {
                                $result .= '<label>' . Defect::typeList($type) . '</label><br>';
                            }
                            //}
                            return $result;
                        },
                        'format' => 'raw'
                    ],
                    'description:text',
                    'compliance_quantity',
                    'compliance_cost',
                    'tex_cost',
                    'tex_quantity',
                ],
            ]) ?>
        </div>
    <?php }

    $measure = Measure::findOne(['control_company_id' => $company->id]);

    if ($measure) { ?>
        <hr>
        <h2>Ko'rilgan ta`sir choralar</h2>
        <div class="result-view">
            <p>
                <?= Html::a('Yangilash', ['/control/measure/update', 'id' => $measure->id], ['class' => 'btn btn-primary']) ?>
            </p>
            <?= DetailView::widget([
                    'model' => $measure,
                    'attributes' => [
//            'id',
                        [
                            'attribute' => 'type',
                            'value' => function (Measure $model) {
                                $res = '';
                                if ($model->type) {
                                    foreach (explode(',', $model->type) as $type) {
                                        $res .= '<label>' . Measure::typeList($type) . '</label><br>';
                                    }
                                }
                                return $res;
                            },
                            'format' => 'raw'
                        ],
                        'date',
                        'quantity',
                        'amount',
                        'ov_date',
                        'ov_quantity',
                        'ov_name',
                        'person',
                        'number_passport',
                        'fine_amount',
                    ],
                ]
            ) ?>
        </div>
    <?php }
} ?>

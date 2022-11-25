<?php

use common\models\Disorder;
use common\models\profilactic\Answer;
use common\models\profilactic\AnswerCountry;
use common\models\profilactic\AnswerStandardCount;
use common\models\profilactic\Company;
use common\models\profilactic\Instruction;
use common\models\profilactic\Result;
use common\models\profilactic\ResultCountry;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\profilactic\Instruction */

$this->title = 'Profilaktika uchun asos';
$this->params['breadcrumbs'][] = ['label' => 'Korxonalar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="instruction-view">

    <p>
        <?= Html::a('Yangilash', ['/profilactic/instruction/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
        if ($model->general_status == Instruction::GENERAL_STATUS_SEND) {
            echo Html::a('Tasdiqlash', ['/profilactic/profilactic/done', 'id' => $model->id], ['class' => 'btn btn-warning']);
        }
        ?>
        <?= Html::a('Hamma ma`lumotni o\'chirish', ['/profilactic/instruction/delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Haqiqatan ham bu elementni o‘chirmoqchimisiz?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'base',
                'value' => function ($model) {
                    return ($model->base || $model->base === 0) ? Instruction::getType($model->base) : '';
                }
            ],
            [
                'attribute' => 'subject',
                'value' => function ($model) {
                    return ($model->subject || $model->subject === 0) ? Instruction::getSubject($model->subject) : '';
                }
            ],
            [
                'attribute' => 'program_type',
                'value' => function ($model) {
                    return ($model->program_type || $model->program_type === 0) ? Instruction::getProgramType($model->program_type) : '';
                }
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return ($model->status || $model->status === 0) ? Instruction::getStatus($model->status) : '';
                }
            ],
            'letter_date',
            'letter_number',
        ],
    ]) ?>

</div>


<?php
$company = Company::findOne(['pro_instruction_id' => $model->id]);
if ($company) { ?>
    <hr>
    <h2>Xyus to'g'risida ma`lumot</h2>
    <div class="company-view">
        <p>
            <?= Html::a('Yangilash', ['/profilactic/company/update', 'id' => $company->id], ['class' => 'btn btn-primary']) ?>
        </p>
        <?= DetailView::widget([
            'model' => $company,
            'attributes' => [
                'name',
                'inn',
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
    $answer = Answer::findOne(['pro_company_id' => $company->id]);
    if ($answer) { ?>
        <hr>
        <h2>Savolnoma</h2>
        <div class="company-view">
            <p>
                <?= Html::a('Yangilash', ['/profilactic/answer/update', 'id' => $answer->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Davlatlar', ['/profilactic/answer-country/index', 'answer_id' => $answer->id], ['class' => 'btn btn-info']) ?>
                <?= Html::a('Standartlar', ['/profilactic/answer-standard/index', 'answer_id' => $answer->id], ['class' => 'btn btn-success']) ?>
            </p>
            <?= DetailView::widget([
                'model' => $answer,
                'attributes' => [
                    'product_type_id',
                    'product_name',
                    'internation_standard',
                    'product_quality',
                    'employee',
                    'smk',
                    'international_certificate',
                    'import_product',
                    'export_product',
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
                    'overall_comment',
                ],
            ]) ?>

        </div>
    <?php }


    $disorder = Disorder::findOne(['company_id' => $model->id]);
    if ($disorder) { ?>
        <hr>
        <h2>Qonun buzilishi holatlari</h2>
        <div class="disorder-view">
            <p>
                <?= Html::a('Yangilash', ['/profilactic/disorder/update', 'id' => $disorder->id], ['class' => 'btn btn-primary']) ?>
            </p>
            <?= DetailView::widget([
                'model' => $disorder,
                'attributes' => [
                    // 'company_id',
                    'standart',
                    'certificate',
                    'metrologic',
                ],
            ]) ?>
        </div>
    <?php } }


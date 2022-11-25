<?php

use common\models\caution\Company;
use common\models\caution\Execution;
use common\models\caution\Instruction;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model Instruction */

$this->title = 'Profilaktika uchun asos';
$this->params['breadcrumbs'][] = ['label' => 'Korxonalar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
    <div class="instruction-view">

        <p>
            <?= Html::a('Yangilash', ['/caution/instruction/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Hamma ma`lumotni o\'chirish', ['/caution/instruction/delete', 'id' => $model->id], [
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
//            'id',
                [
                    'attribute' => 'base',
                    'value' => function ($model) {
                        return Instruction::getType($model->base);
                    }
                ],
                'letter_date:date',
                'letter_number',
//            'product',
//            'phone',
//            'address',
//            'created_by',
//            'updated_by',
//            'created_at',
//            'updated_at',
            ],
        ]) ?>

    </div>


<?php
$company = Company::findOne(['caution_instruction_id' => $model->id]);
if ($company) { ?>
    <hr>
    <h2>Xyus to'g'risida ma`lumot</h2>
    <div class="company-view">
        <p>
            <?= Html::a('Yangilash', ['/caution/company/update', 'id' => $company->id], ['class' => 'btn btn-primary']) ?>
        </p>
        <?= DetailView::widget([
            'model' => $company,
            'attributes' => [
                'name',
                'inn',
                [
                    'attribute' => 'phone',
                    'value' => function (Company $model) {
                        return $model->phoneNumber;
                    },
                ],
                [
                    'label' => 'Hudud',
                    'value' => function (Company $model) {
                        return $model->region->name;
                    }
                ],
                'after',
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
    $execution = Execution::findOne(['caution_company_id' => $company->id]);
    if ($execution) { ?>
        <hr>
        <h2>Mahsulot to'g'risida ma`lumot</h2>
        <div class="company-view">
            <p>
                <?= Html::a('Yangilash', ['/caution/execution/update', 'id' => $execution->id], ['class' => 'btn btn-primary']) ?>
            </p>
            <?= DetailView::widget([
                'model' => $execution,
                'attributes' => [
//                    'id',
//                    'pro_company_id',
                    'date:date',
                    'number',
                    'description',
                    'deficiency',
                ],
            ]) ?>
        </div>
    <?php }
} ?>
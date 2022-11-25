<?php

/* @var $this yii\web\View */

/* @var $model Instruction */

use common\models\control\Company;
use common\models\control\Instruction;
use common\models\control\InstructionUser;
use frontend\widgets\Steps;
use yii\widgets\DetailView;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;

$company = Company::findOne(['control_instruction_id' => $model->id])
?>


<div class="page1-1 row ">

    <?= Steps::widget([
        'control_instruction_id' => $model->id,
        'control_company_id' => $company ? $company->id : null,
    ]) ?>

    <div class="col-6">
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
                'letter_date',
                'letter_number',
                'command_date',
                'command_number',
                'checkup_begin_date',
                [
                    'attribute' => 'checkup_finish_date',
                    'value' => function(Instruction $model) {
                        return $model->checkup_finish_date ? $model->checkup_finish_date : '';
                    }
                ],
                [
                    'label' => 'Inspektorlar',
                    'value' => function ($model) {
                        $users = InstructionUser::find()->where(['instruction_id' => $model->id])->all();
                        $result = '';
                        foreach ($users as $user) {
                            $result .= '<span class="text-secondary">' . $user->user->name . ' ' . $user->user->surname . '</span><br>';
                        }
                        return $result;
                    },
                    'format' => 'raw'
                ],
//            'created_by',
//            'updated_by',
//            'created_at',
//            'updated_at',
            ],
        ]) ?>
    </div>

</div>

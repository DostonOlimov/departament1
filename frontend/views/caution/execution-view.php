<?php

/* @var $this yii\web\View */
/* @var $model Execution */

use common\models\caution\Execution;
use frontend\widgets\StepsCautions;
use yii\widgets\DetailView;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="page1-1 row ">

    <?= StepsCautions::widget([
        'caution_instruction_id' => $model->cautionCompany->caution_instruction_id,
        'caution_company_id' => $model->caution_company_id,
    ]) ?>

    <div class="col-6">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
//            'id',
                'date:date',
                'number',
                'description:text',
                'deficiency',
//            'created_by',
//            'updated_by',
//            'created_at',
//            'updated_at',
            ],
        ]) ?>
    </div>

</div>

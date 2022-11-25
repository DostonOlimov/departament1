<?php

/* @var $this yii\web\View */
/* @var $model Measure */

use common\models\control\Measure;
use frontend\widgets\Steps;
use yii\widgets\DetailView;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="page1-1 row ">

    <?= Steps::widget([
        'control_instruction_id' => $model->controlCompany->control_instruction_id,
        'control_company_id' => $model->control_company_id,
    ]) ?>

    <div class="col-6">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
//            'id',
                [
                    'attribute' => 'type',
                    'value' => function (Measure $model) {
                        $res = '';
                        if ($model->type) {
                            foreach (explode(',', $model->type) as $type) {
                                $res .= '<label>' . $type ? Measure::typeList($type) : ' ' . '</label><br>';
                            }
                        }
                        return $res;
                    },
                    'format' => 'raw'
                ],
                'date',
                'quantity',
                'ov_date',
                'ov_quantity',
                'ov_name',
                'amount',
                'person',
                'number_passport',
                'fine_amount',
            ],
        ]) ?>
    </div>

</div>

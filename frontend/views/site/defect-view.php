<?php

/* @var $this yii\web\View */
/* @var $model ControlDefect */

use common\models\ControlDefect;
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
                    'value' => function (ControlDefect $model) {
                        $result = '';
                        foreach ($model->type as $type) {
                            $result .= '<label>' . ControlDefect::typeList($type) . '</label><br>';
                        }
                        return $result;
                    },
                    'format' => 'raw'
                ],
                'description:text',
            ],
        ]) ?>
    </div>

</div>

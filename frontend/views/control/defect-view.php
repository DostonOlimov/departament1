<?php

/* @var $this yii\web\View */
/* @var $model Defect */

use common\models\control\Defect;
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
                    'value' => function (Defect $model) {
                        $result = '';
                        $model->type = explode('.', substr($model->type, 1));
//                        \yii\helpers\VarDumper::dump($model->type);die;
                        foreach ($model->type as $type) {
                            $result .= '<label>' . Defect::typeList($type) . '</label><br>';
                        }
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

</div>

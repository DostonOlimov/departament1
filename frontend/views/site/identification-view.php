<?php

/* @var $this yii\web\View */
/* @var $model ControlIdentification */

use common\models\ControlIdentification;
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
                    'attribute' => 'file',
                    'value' => function (ControlIdentification $model) {
                        return '<img src="' . $model->getThumbFileUrl('file', 'md') . '" >';
                    },
                    'format' => 'raw'
                ],
                'description:text',
            ],
        ]) ?>
    </div>

</div>

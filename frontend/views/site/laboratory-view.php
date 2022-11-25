<?php

/* @var $this yii\web\View */
/* @var $model Laboratory */

use common\models\ControlIdentification;
use common\models\Laboratory;
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
                    'attribute' => 'dalolatnoma',
                    'value' => function (Laboratory $model) {
                        return '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('dalolatnoma') . '" download>Yuklash</>';
                    },
                    'format' => 'raw'
                ],
                [
                    'attribute' => 'bayonnoma',
                    'value' => function (Laboratory $model) {
                        return '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('bayonnoma') . '" download>Yuklash</>';
                    },
                    'format' => 'raw'
                ],
                'description:text',
            ],
        ]) ?>
    </div>

</div>

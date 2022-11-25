<?php

/* @var $this yii\web\View */

/* @var $model Laboratory */

use common\models\control\Laboratory;
use frontend\models\LaboratoryHelper;
use frontend\widgets\Steps;
use yii\widgets\DetailView;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="page1-1 row ">
    <?php
    function DelayForm($name)
    {
        echo "<form href='#' method='post' >
            <button type='button'>Faylni saqlash<input type='file' name='$name' ></button>
            </form>";
    }

    ?>
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

</div>

<?php

/* @var $this yii\web\View */
/* @var $model Identification */

use common\models\control\Company;
use common\models\control\Identification;
use frontend\widgets\Steps;
use yii\widgets\DetailView;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="page1-1 row ">

    <?= Steps::widget([
        'control_instruction_id' => Company::findOne($id) ? Company::findOne($id)->control_instruction_id : null,
        'control_company_id' => $id,
    ]) ?>

    <div class="col-6">
        <?php
        if ($model)
            foreach ($model as $mod) {
                echo DetailView::widget([
                    'model' => $mod,
                    'attributes' => [
//            'id',
                        [
                            'attribute' => 'file',
                            'value' => function (Identification $model) {
                                $model->img = $model->file;
                                return $model->img ? '<a class="btn btn-info" target="_blank" href="' . $model->getUploadedFileUrl('img') . '" >Yuklash</a>' : '';
                            },
                            'format' => 'raw'
                        ],
                        'identification:text',
                    ],
                ]) ;
            }

        ?>
    </div>

</div>

<?php

/* @var $this yii\web\View */

/* @var $model Caution */

use common\models\control\Caution;
use common\models\control\Company;
use frontend\widgets\Steps;
use yii\widgets\DetailView;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;
//\yii\helpers\VarDumper::dump($model,12,true);die;
?>

<div class="page1-1 row">

    <?= Steps::widget([
        'control_instruction_id' => Company::findOne($id) ? Company::findOne($id)->control_instruction_id : null,
        'control_company_id' => $id,
    ]) ?>

    <div class="col-6">
        <?php
        if ($model) {
            foreach ($model as $mod) {
                echo DetailView::widget([
                    'model' => $mod,
                    'attributes' => [
                        [
                            'attribute' => 'caution',
                            'value' => function (Caution $model) {
                                return array_key_exists($model->caution, Caution::getType()) ? Caution::getType($model->caution) : '';
                            },
                            'format' => 'raw'
                        ],
                        'caution_date',
                        'caution_number',
                        [
                            'attribute' => 'file',
                            'value' => function (Caution $model) {
                                $model->s_file = $model->file;
                                return $model->s_file ? '<a class="btn btn-info" href="' . $model->getUploadedFileUrl('s_file') . '" download>Yuklash<a/>' : '';

                            },
                            'format' => 'raw'
                        ],
                        'description:text',
                    ],
                ]);
            }
        }
        ?>
    </div>

</div>

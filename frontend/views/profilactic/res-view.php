<?php

/* @var $this yii\web\View */
/* @var $model Result */

use common\models\profilactic\Company;
use common\models\profilactic\Result;
use frontend\widgets\StepsProfilactic;
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="page1-1 row ">

    <?= StepsProfilactic::widget([
        'pro_instruction_id' => Company::findOne($model->pro_company_id)->pro_instruction_id,
        'pro_company_id' => $model->pro_company_id,
    ]) ?>

    <div class="col-6">
        <p>
            <?= Html::a('O\'zgartirish', ['/profilactic/results', 'company_id' => $model->pro_company_id, 'selfId' => $model->id], ['class' => 'btn btn-info']) ?>
        </p>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
//            'id',
                [
                    'label' => 'Me\'yoriy hujjatlarni aktuallashtirish (soni va nomi):',
                    'value' => function (Result $model) {
                        return $model->active_count . ' ' . $model->active_name;
                    }
                ],
                [
                    'label' => 'O\'lchov vositalari bo\'yicha amaliy yordam (soni va nomi):',
                    'value' => function (Result $model) {
                        return $model->measure_help_count . ' ' . $model->measure_help_name;
                    }
                ],
                [
                    'label' => 'Import/Export ga amaliy yordam',
                    'value' => function (Result $model) {
                        return $model->import_export == 1 ? 'Eksport' : 'Import';
                    }
                ],
                'import_export_text',
                'certificate_help',
                'certificate_text',
                'decision',
                'decision_text',
                'smk',
                'smk_text',
                'problem',
                'people',
//            'created_by',
//            'updated_by',
//            'created_at',
//            'updated_at',
            ],
        ]) ?>
    </div>

</div>

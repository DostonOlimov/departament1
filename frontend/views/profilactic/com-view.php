<?php

/* @var $this yii\web\View */
/* @var $model Company */

use common\models\profilactic\Company;
use frontend\widgets\StepsProfilactic;
use yii\widgets\DetailView;

$this->title = 'Davlat nazoratini o\'tkazish uchun asos';
$this->params['breadcrumbs'][] = $this->title;

$proCompany = Company::findOne(['pro_instruction_id' => $model->id])
?>


<div class="page1-1 row ">

    <?= StepsProfilactic::widget([
        'pro_instruction_id' => $model->proInstruction->id,
        'pro_company_id' => $model->id,
    ]) ?>

    <div class="col-6">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
//            'id',
                'name',
                'inn',
                'address',
                // 'type',
                [
                    'attribute' => 'phone',
                    'value' => function (Company $model) {
                        return $model->phoneNumber;
                    },
                ],
                [
                    'attribute' => 'region_id',
                    'value' => function (Company $model) {
                        return $model->region->name;
                    },
                ],
//            'created_by',
//            'updated_by',
//            'created_at',
//            'updated_at',
            ],
        ]) ?>
    </div>

</div>

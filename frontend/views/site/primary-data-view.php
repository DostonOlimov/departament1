<?php

/* @var $this yii\web\View */

/* @var $model ControlPrimaryData */

use common\models\ControlPrimaryData;
use common\models\ControlPrimaryProduct;
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
                'count',
                'product_type',
                'certificate',
                'residue_quantity',
                'residue_amount',
                'year_quantity',
                'year_amount',
                'potency',
                [
                    'label' => 'Mahsulot',
                    'value' => function (ControlPrimaryData $model) {
                        $products = ControlPrimaryProduct::find()->where(['control_primary_data_id' => $model->id])->all();
                    }
                ],
            ],
        ]) ?>
    </div>

</div>

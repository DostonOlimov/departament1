<?php

/* @var $this yii\web\View */
/* @var $model Disorder */

use common\models\Disorder;
use common\models\profilactic\Company;
use frontend\widgets\StepsProfilactic;
use yii\widgets\DetailView;

$this->title = 'Qonun buzilish holatlari';
$this->params['breadcrumbs'][] = $this->title;

// $proCompany = Company::findOne($model->pro_company_id)
?>


<div class="page1-1 row ">
<?= StepsProfilactic::widget([
        'pro_instruction_id' => Company::findOne($model->company_id)->pro_instruction_id,
        'pro_company_id' => $model->company_id,
    ]) ?>

<div class="col-6">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'company_id',
                'standart',
                'certificate',                
                'metrologic',                
            ],
        ]) ?>
    </div>


</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\caution\Execution */

$this->title = 'Yangilash: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Korxonalar', 'url' => ['caution/caution/index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['caution/caution/view', 'id' => $model->cautionCompany->caution_instruction_id]];
$this->params['breadcrumbs'][] = 'Xyus to\'g\'risida ma`lumot';
?>
<div class="pro-company-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

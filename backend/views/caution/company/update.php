<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\caution\Company */

$this->title = 'Yangilash: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Korxonalar', 'url' => ['caution/caution/index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['caution/caution/view', 'id' => $model->caution_instruction_id]];
$this->params['breadcrumbs'][] = 'Xyus to\'g\'risida ma`lumot';
?>
<div class="pro-company-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

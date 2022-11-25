<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\shopping\Company */

$this->title = 'Yangilash: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Korxonalar', 'url' => ['shopping/shopping/index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['shopping/shopping/view', 'id' => $model->shopping_instruction_id]];
$this->params['breadcrumbs'][] = 'Xyus to\'g\'risida ma`lumot';
?>
<div class="pro-company-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

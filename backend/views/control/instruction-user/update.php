<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\control\InstructionUser */

$this->title = 'Foydalanuvchni o\'zgartirish';
$this->params['breadcrumbs'][] = ['label' => 'Foydalanuvchni ko\'rish', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="instruction-user-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

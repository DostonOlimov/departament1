<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\control\InstructionUser */

$this->title = 'Foydalanuvchni qo\'shish';
$this->params['breadcrumbs'][] = ['label' => 'Foydalanuvchilar', 'url' => ['index', 'instruction_id' => $instruction_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="instruction-user-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

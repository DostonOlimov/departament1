<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProgramType */

$this->title = 'Dastur turi';
$this->params['breadcrumbs'][] = ['label' => 'Dastur turi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-type-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

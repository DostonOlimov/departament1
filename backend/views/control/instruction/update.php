<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\control\Instruction */

$this->title = 'Yangilash: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Korxonalar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['/control/control/view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="control-instruction-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

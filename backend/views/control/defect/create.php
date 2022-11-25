<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\control\Defect */

$this->title = 'Create Defect';
$this->params['breadcrumbs'][] = ['label' => 'Defects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="defect-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

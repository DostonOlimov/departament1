<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ShoppingInstruction */

$this->title = 'Create Shopping Instruction';
$this->params['breadcrumbs'][] = ['label' => 'Shopping Instructions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shopping-instruction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

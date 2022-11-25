<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProCompany */

$this->title = 'Create Pro Company';
$this->params['breadcrumbs'][] = ['label' => 'Pro Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pro-company-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\control\PrimaryData */

$this->title = 'Create Primary Data';
$this->params['breadcrumbs'][] = ['label' => 'Primary Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="primary-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

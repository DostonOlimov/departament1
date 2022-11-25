<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\control\Identification */

$this->title = 'Qo\'shish';
$this->params['breadcrumbs'][] = ['label' => 'Identifikatsiya', 'url' => ['index', 'company_id' => $model->control_company_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="identification-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

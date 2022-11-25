<?php

/**@var $caution_company_id */
/**@var $caution_instruction_id */

use common\models\caution\Company;
use yii\helpers\Url;

$action = Yii::$app->controller->action->id;

$hrefIns = ($caution_instruction_id) ? '/caution/instruction-view?id=' . $caution_instruction_id : '/caution/instruction';
$classIns = ($action == 'instruction' || $action == 'instruction-view') ? 'active' : ($caution_instruction_id ? 'actived' : '');

$hrefCom = ($caution_company_id) ?  Url::to(['/caution/company-view', 'id' => $caution_company_id])  : Url::to(['/caution/company', 'instruction_id' => $caution_instruction_id]);
$classCom = ($action == 'company' || $action == 'company-view') ? 'active' : ($caution_instruction_id ? 'actived' : 'disabled');

$hrefExecution = '';
$classExecution = 'disabled';

if ($caution_company_id) {
    $cautionCompany = Company::findOne($caution_company_id);

    $hrefExecution = $cautionCompany->execution ? Url::to(['/caution/execution-view', 'id' => $cautionCompany->execution->id]) : Url::to(['/caution/execution', 'company_id' => $caution_company_id]);
    $classExecution = ($action == 'execution' || $action == 'execution-view') ? 'active' : 'actived';
}
?>

<div class="col-3  list-group margin-top">
    <a href="javascript:void(0);" class="list-group-item list-group-item-action notHover">Berilgan ko'rsatma va ogohlantirishlar</a>
    <a href="<?= $hrefIns ?>" class="list-group-item list-group-item-action <?= $classIns ?>">Ko'rsatma berish uchun asos</a>
    <a href="<?= $hrefCom ?>" class="list-group-item list-group-item-action <?= $classCom ?>">XYUS to'g'risida ma'lumot</a>
    <a href="<?= $hrefExecution ?>" class="list-group-item list-group-item-action <?= $classExecution ?>">Ko'rsatmalar ijrosi</a>

</div>

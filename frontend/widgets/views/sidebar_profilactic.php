<?php

/**@var $pro_company_id */

/**@var $pro_instruction_id */

use common\models\profilactic\Answer;
use common\models\profilactic\Result;
use common\models\Disorder;

$action = Yii::$app->controller->action->id;
$controller = Yii::$app->controller->id;
$url = $controller . '/' . $action;
$request = Yii::$app->request;
$type = $request->get('type');

$hrefIns = ($pro_company_id || $pro_instruction_id) ? '/profilactic/ins-view?id=' . $pro_instruction_id : '/profilactic/instruction';
$classIns = ($url == 'profilactic/instruction' || $url == 'profilactic/ins-view') ? 'active' : ($pro_instruction_id ? 'actived' : '');

$hrefCom = ($pro_company_id) ? '/profilactic/com-view?id=' . $pro_company_id : '/profilactic/xyus-information?instruction_id=' . $pro_instruction_id;
$classCom = ($url == 'profilactic/xyus-information' || $url == 'profilactic/com-view') ? 'active' : (($pro_company_id || $pro_instruction_id) ? 'actived' : 'disabled');

$answer = Answer::findOne(['pro_company_id' => $pro_company_id]);
$hrefAns = $answer ? '/profilactic/ans-view?id=' . $answer->id : '/profilactic/questionnaire?company_id=' . $pro_company_id;
$classAns = ($url == 'profilactic/ans-view' || $url == 'profilactic/questionnaire') ? 'active' : (($answer || $pro_company_id) ? 'actived' : 'disabled');

$disorder = Disorder::findOne(['company_id' => $pro_company_id, 'type' => 0]);
$hrefDis = $disorder ? '/profilactic/dis-view?id=' . $disorder->id.'&type=0': '/profilactic/disorder?company_id='.$pro_company_id.'&type=0';
$classDis = (($url == 'profilactic/dis-view' && $type == 0) || ($url == 'profilactic/disorder' && $type == 0)) ? 'active' : (($disorder || $answer) ? 'actived' : 'disabled');

$disorderHelp = Disorder::findOne(['company_id' => $pro_company_id, 'type' => 1]);
$hrefDisHelp = $disorderHelp ? '/profilactic/dis-view?id=' . $disorderHelp->id.'&type=1': '/profilactic/disorder?company_id='.$pro_company_id.'&type=1';
$classDisHelp = (($url == 'profilactic/dis-view' && $type == 1) || ($url == 'profilactic/disorder' && $type == 1)) ? 'active' : (($disorderHelp || $answer) ? 'actived' : 'disabled');

$result = Result::findOne(['pro_company_id' => $pro_company_id]);
$hrefRes = $result ? '/profilactic/res-view?id=' . $result->id : '/profilactic/results?company_id=' . $pro_company_id;
$classRes = ($url == 'profilactic/res-view' || $url == 'profilactic/results') ? 'active' : (($result || $disorderHelp) ? 'actived' : 'disabled');

?>

<div class="col-3  list-group margin-top">
    <a href="javascript:void(0);" class="list-group-item list-group-item-action  notHover">Profilaktika</a>
    <a href="<?= $hrefIns ?>" class="list-group-item list-group-item-action <?= $classIns ?>">Profilaktika uchun asos</a>
    <a href="<?= $hrefCom ?>" class="list-group-item list-group-item-action <?= $classCom ?>">XYUS to'g'risida ma'lumot</a>
    <a href="<?= $hrefAns ?>" class="list-group-item list-group-item-action <?= $classAns ?>">Savolnoma</a>
    <a href="<?= $hrefDis ?>" class="list-group-item list-group-item-action <?= $classDis ?>">Korxonada sohaga oid kamchilik va muammolar</a>
    <a href="<?= $hrefDisHelp ?>" class="list-group-item list-group-item-action <?= $classDisHelp ?>">Kamchilik va muammolar yuzasidan ko’rsatilgan amaliy yordam</a>
</div>

<?php

namespace console\controllers;

use common\models\User;
use Yii;
use yii\console\Controller;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * Interactive console roles manager
 */
class RoleController extends Controller
{

    public function actionAssign()    {
        $username = $this->prompt('Username:', ['required' => true]);
        $ddd = $this->getBy(['username' => $username]);
        $role = $this->select('Role:', ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description'));
        $this->assignRole($ddd->id, $role);
        $this->stdout('Done!' . PHP_EOL);
    }

    public function assignRole($id, $role)
    {
        $bbb = $this->getBy(['id' => $id]);
        $this->assign($bbb->id, $role);
    }

    public function assign($userId, $name)    {
        if (!$role = Yii::$app->authManager->getRole($name)) {
            throw new \DomainException('Role "' . $name . '" does not exist.');
        }
        Yii::$app->authManager->revokeAll($userId);
        Yii::$app->authManager->assign($role, $userId);
    }

    private function getBy($condition)
    {
        if (!$aaa = User::find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundHttpException('User not found.');
        }
        return $aaa;
    }
}

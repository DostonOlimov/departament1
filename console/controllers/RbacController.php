<?php

namespace console\controllers;

use yii\console\Controller;
use const PHP_EOL;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = \Yii::$app->getAuthManager();

        // Roles

        $supervisor = $auth->createRole('supervisor');
        $supervisor->description = 'Nazoratchi';
        $auth->add($supervisor);

        $inspector = $auth->createRole('inspector');
        $inspector->description = 'Inspektor';
        $auth->add($inspector);

        $admin = $auth->createRole('admin');
        $admin->description = 'Admin';
        $auth->add($admin);


        // add children role

        $auth->addChild($admin, $supervisor);
        $auth->addChild($admin, $inspector);

        $this->stdout('Done!' . PHP_EOL);
    }

    public function actionTest()
    {
        $request = new \yii\web\Request();

        $request->enableCookieValidation = false;
        $request->enableCsrfValidation = false;
        $request->enableCsrfCookie = false;
        \Yii::$app->set('request', $request);

        $auth = \Yii::$app->getAuthManager();

        var_dump($auth->getRole('fdsfsd'));
//
//        $user = User::findOne(8);
//        $admin = User::findOne(5);
//        $auth = \Yii::$app->getAuthManager();
//
//        $auth->assign($auth->getRole('user'), $user->id);
//
//        $auth->assign($auth->getRole('administrator'), $admin->id);
//
//        \Yii::$app->user->login($user);
//
//        var_dump(\Yii::$app->user->can('createUser'));
//
//
//        \Yii::$app->user->login($admin);
//
//        var_dump(\Yii::$app->user->can('createUser'));

        echo PHP_EOL;

    }
}

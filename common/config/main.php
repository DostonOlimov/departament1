<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@url'   => 'http://dep.standart.uz/',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => \yii\rbac\PhpManager::class,
            'itemFile' => '@common/component/rbac/items.php',
            'assignmentFile' => '@common/component/rbac/assignments.php',
            'ruleFile' => '@common/component/rbac/rules.php'

        ],
    ],
];

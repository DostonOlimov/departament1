<?php

/* @var $this \yii\web\View */

/* @var $content string */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap4\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

        <?= $this->render('_header') ?>
        <?= Alert::widget() ?>
<!--    <div style="margin-left: 20vw !important;">-->
        <?= $content ?>
<!--    </div>-->


    <?php $this->endBody() ?>
    <script src="https://kit.fontawesome.com/f107c55bf5.js" crossorigin="anonymous"></script>
    </body>
    </html>
<?php $this->endPage();

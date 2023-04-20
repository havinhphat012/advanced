<?php

use backend\assets\LoginAsset;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

LoginAsset::register($this);
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
    <body class="login-page d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <div class="wrap">
        <div class="container">
            <?=$content ?>
        </div>
    </div>

    <footer class="footer mt-auto py-3 text-muted">
        <div class="container">
            <div class="pull-left">
                &copy My Company <?=date ('Y')?>
            </div>
            <div class="pull-right">
                <?=Yii::powered()?>
            </div>
        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();

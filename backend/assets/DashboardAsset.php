<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class DashboardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/adminlte.min.css',
        'css/fontawesome-free/css/all.min.css',
        'css/icheck-bootstrap.min.css',
        'css/tempusdominus-bootstrap-4.min.css',
        '//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
    ];
    public $js = [
        'js/bootstrap.min.js',
        'js/dashboard.js',
        'js/jquery-ui/jquery-ui.min.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap5\BootstrapAsset',
    ];
}

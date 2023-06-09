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
        '//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css',
        'css/icheck-bootstrap.min.css',
        'css/tempusdominus-bootstrap-4.min.css',
        '//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
    ];
    public $js = [
        'js/bootstrap.min.js',
        'js/dashboard.js',
        'js/jquery-ui/jquery-ui.min.js',
        'css/jqvmap/jqvmap.min.css',
        'css/sparklines/sparkline.js',
        'js/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap4\BootstrapAsset',
    ];
}

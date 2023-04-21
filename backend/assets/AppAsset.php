<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author xinchaomont <xinchaomint@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
        'backend\assets\DashboardAsset',
    ];
}

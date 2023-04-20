<?php
/**
 *
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @licence http://www.yiiframework.com/licence/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author xichaomont<Xichaomont@gmail,com>
 * @since 2.0
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/tempusdominus-bootstrap-4.min.css',
        '//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css',
        'css/adminlte.min.css',
        'css/icheck-bootstrap.min.css',
        'css/all.min.css',
        'css/site.css',
    ];
    public $js = [
        'js/jquery-ui.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}

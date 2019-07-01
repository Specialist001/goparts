<?php

namespace frontend\assets;
use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/jquery.scrollbar.css',
        'css/owl.carousel.min.css',
        'css/owl.theme.default.min.css',
        'css/select2.min.css',
        'css/jquery.fancybox.min.css',
        'css/checkbox.css',
        'css/line-awesome.min.css',
        'css/site.css',
        'css/style.css',
    ];
    public $js = [
//        'js/jquery-3.3.1.slim.min.js',
//        'js/jquery.min.js',
        'js/owl.carousel.min.js',
        'js/popper.min.js',
        'js/bootstrap.min.js',
        'js/select2.min.js',
        'js/jquery.fancybox.min.js',
        'js/jquery.scrollbar.js',
        'js/script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
//        'yii\bootstrap\BootstrapPluginAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
    ];
}

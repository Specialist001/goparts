<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/select2.min.css',
        'css/morris.css',
        'css/line-awesome.min.css',
        'css/site.css',
    ];
    public $js = [
        'js/select2.min.js',
        'js/jquery-nicescroll/jquery.nicescroll.min.js',
        'js/notify.min.js',
        'js/raphael/raphael.js',
        'js/morris.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}

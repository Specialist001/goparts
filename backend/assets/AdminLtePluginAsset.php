<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AdminLtePluginAsset extends AssetBundle
{
    public $basePath = '@vendor/almasaeed2010/adminlte';
    public $css = [
        'plugins/datatables/dataTables.bootstrap.css',
        'bower_components/Ionicons/css/ionicons.min.css',
//        'bower_components/Ionicons/css/ionicons.min.css',
    ];
    public $js = [
        'datatables/dataTables.bootstrap.min.js',
        'bower_components/morris.js/morris.min.js',
    ];
    public $depends = [
        'dmstr\web\AdminLteAsset',
    ];
}

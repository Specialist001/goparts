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
        'plugins/datatables/dataTables.bootstrap.css',
        'bower_components/Ionicons/ionicons.min.css',
    ];
    public $js = [
        'plugins/datatables/dataTables.bootstrap.min.js',
    ];
    public $depends = [
        'dmstr\web\AdminLteAsset',
    ];
}

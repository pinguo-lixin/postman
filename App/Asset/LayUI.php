<?php
namespace App\Asset;

use yii\web\AssetBundle;

class LayUI extends AssetBundle
{
    public $sourcePath = '@webroot/plugins/layui';
    public $css = [
        'css/layui.css',
    ];
    public $js = [
        'layui.js',
    ];
}

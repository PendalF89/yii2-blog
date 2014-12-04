<?php

namespace pendalf89\blog\assets;

use yii\web\AssetBundle;

/**
 * This declares the asset files required by Blog.
 *
 * @author Zabolotskikh Boris <zabolotskich@bk.ru>
 */
class BlogAsset extends AssetBundle
{
    public $sourcePath = '@vendor/pendalf89/yii2-blog/assets/source';
    public $css = ['css/main.css'];
    public $depends = ['yii\bootstrap\BootstrapAsset'];
}

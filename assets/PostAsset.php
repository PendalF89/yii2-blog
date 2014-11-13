<?php

namespace pendalf89\blog\assets;

use yii\web\AssetBundle;

/**
 * This declares the asset files required by Blog.
 *
 * @author Zabolotskikh Boris <zabolotskich@bk.ru>
 */
class PostAsset extends AssetBundle
{
    public $sourcePath = '@vendor/pendalf89/yii2-blog/assets/source/js';
    public $js = [
        'post.js',
    ];
    public $depends = [
        'mihaildev\elfinder\AssetsCallBack',
    ];
}

<?php

namespace pendalf89\blog\assets;

use yii\web\AssetBundle;

/**
 * This declares the asset files required by duplicate script.
 *
 * @author Zabolotskikh Boris <zabolotskich@bk.ru>
 */
class DuplicateAsset extends AssetBundle
{
    public $sourcePath = '@vendor/pendalf89/yii2-blog/assets/source/js';
    public $depends = [
        'yii\web\JqueryAsset',
    ];

    public function init()
    {
        parent::init();

        $this->js = [
            YII_ENV_PROD ? 'duplicate.js' : 'duplicate.min.js',
        ];
    }
}

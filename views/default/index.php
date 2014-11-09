<?php

use yii\helpers\Html;
use yii\grid\GridView;
use pendalf89\blog\Module;
use pendalf89\blog\helpers\Helper;
use pendalf89\blog\assets\BlogAsset;

/* @var $this yii\web\View */
/* @var $searchModel pendalf89\blog\models\TypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('main', 'Blog');
$this->params['breadcrumbs'][] = $this->title;

$assetPath = BlogAsset::register($this)->baseUrl;
?>

<div class="blog-default-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-4">

            <div class="text-center">
                <h2>
                    <?= Html::a(Module::t('main', 'Posts'), ['/blog/post/index']) ?>
                </h2>
                <?= Html::a(
                    Html::img($assetPath . '/images/posts.png', ['alt' => 'Notepad'])
                    , ['/blog/post/index']
                ) ?>
            </div>
        </div>

        <div class="col-md-4">

            <div class="text-center">
                <h2>
                    <?= Html::a(Module::t('main', 'Categories'), ['/blog/category/index']) ?>
                </h2>
                <?= Html::a(
                    Html::img($assetPath . '/images/categories.png', ['alt' => 'Categories'])
                    , ['/blog/category/index']
                ) ?>
            </div>
        </div>

        <div class="col-md-4">

            <div class="text-center">
                <h2>
                    <?= Html::a(Module::t('main', 'Post types'), ['/blog/type/index']) ?>
                </h2>
                <?= Html::a(
                    Html::img($assetPath . '/images/post-types.png', ['alt' => 'Nightstand'])
                    , ['/blog/type/index']
                ) ?>
            </div>
        </div>
    </div>
</div>

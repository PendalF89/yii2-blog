<?php

use yii\helpers\Html;
use pendalf89\blog\Module;
use pendalf89\blog\helpers\Helper;
use pendalf89\blog\assets\BlogAsset;
use kartik\alert\Alert;

/* @var $this yii\web\View */
/* @var $searchModel pendalf89\blog\models\TypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('main', 'Blog');
$this->params['breadcrumbs'][] = $this->title;

$assetPath = BlogAsset::register($this)->baseUrl;
?>

<div class="blog-default-index">
    <h1><?= Module::t('main', 'Blog module'); ?></h1>

    <?php if (Helper::isJustInstalled()) : ?>
        <?= Alert::widget([
            'type' => Alert::TYPE_SUCCESS,
            'title' => Module::t('main', 'Welcome to the module “Blog”!'),
            'icon' => 'glyphicon glyphicon-ok-sign',
            'body' => Module::t('main', 'You have successfully installed the module “Blog” is now to create a record, you need to create your first post type and category'),
            'showSeparator' => true,
        ]); ?>
    <?php endif; ?>

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

<!--        <div class="col-md-3">-->
<!---->
<!--            <div class="text-center">-->
<!--                <h2>-->
<!--                    --><?//= Html::a(Module::t('main', 'Settings'), ['/blog/default/settings']) ?>
<!--                </h2>-->
<!--                --><?//= Html::a(
//                    Html::img($assetPath . '/images/settings.png', ['alt' => 'Tools'])
//                    , ['/blog/default/settings']
//                ) ?>
<!--            </div>-->
<!--        </div>-->
    </div>
</div>
<?php

use pendalf89\blog\Module;
use pendalf89\blog\helpers\Helper;
use pendalf89\blog\assets\BlogAsset;
use kartik\widgets\Alert;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel pendalf89\blog\models\TypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('main', 'Settings');
$this->params['breadcrumbs'][] = ['label' => Module::t('main', 'Blog'), 'url' => ['/blog/default/index']];
$this->params['breadcrumbs'][] = $this->title;

$assetPath = BlogAsset::register($this)->baseUrl;
?>

<div class="blog-default-settings">
    <h1><?= $this->title ?></h1>

    <div class="panel panel-default">
        <div class="panel-heading"><?= Module::t('main', 'Thumbnails settings') ?></div>
        <div class="panel-body">
            <?php if (Yii::$app->session->getFlash('successResize')) : ?>
                <?= Alert::widget([
                    'type' => Alert::TYPE_SUCCESS,
                    'title' => Module::t('main', 'Thumbnails sizes has been resized successfully!'),
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'body' => Module::t('main', 'Do not forget every time you change thumbnails presets to make them resize.'),
                    'showSeparator' => true,
                ]); ?>
            <?php endif; ?>
            <p><?= Module::t('main', 'Now using next thumbnails presets') ?>:</p>
            <ul>
                <?php foreach ($this->context->module->thumbnails as $name => $preset) : ?>
                    <li>
                        <strong><?= $name ?>:</strong> <?= $preset[0] .' x ' . $preset[1] ?>
                        <?php if ($name === $this->context->module->gridViewThumbnail) : ?>
                            <small class="text-muted">
                                (<?= Helper::strtolower(Module::t('main', 'Using as admin grid view thumbnail')) ?>)
                            </small>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <p><?= Module::t('main', 'If you change the thumbnails sizes, it is strongly recommended to make resize all thumbnails.') ?></p>
            <?= Html::a(Module::t('main', 'Do resize thumbnails'), '/blog/default/resize', ['class' => 'btn btn-danger']) ?>
        </div>
    </div>
</div>
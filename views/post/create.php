<?php

use yii\helpers\Html;
use pendalf89\blog\Module;
use pendalf89\blog\helpers\Helper;
use pendalf89\blog\assets\TranslitAsset;
use pendalf89\blog\assets\DuplicateAsset;


/* @var $this yii\web\View */
/* @var $model pendalf89\blog\models\Post */

$this->title = Module::t('main', 'New {type}', ['type' => Helper::strtolower($model->type->title)]);
$this->params['breadcrumbs'][] = ['label' => Module::t('main', 'Blog'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => Module::t('main', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

if ($this->context->module->autoTranslit) {
    TranslitAsset::register($this);
}

DuplicateAsset::register($this);
?>
<div class="post-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model]) ?>

</div>

<?php

use pendalf89\blog\Module;
use pendalf89\blog\assets\TranslitAsset;

/* @var $this yii\web\View */
/* @var $model pendalf89\blog\models\Category */

if ($this->context->module->autoTranslit) {
    TranslitAsset::register($this);
}

$this->title = Module::t('main', 'New category');
$this->params['breadcrumbs'][] = ['label' => Module::t('main', 'Blog'), 'url' => ['/blog/default/index']];
$this->params['breadcrumbs'][] = ['label' => Module::t('main', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

    <h1><?= $this->title ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

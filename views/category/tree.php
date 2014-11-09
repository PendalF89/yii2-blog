<?php

use pendalf89\blog\Module;
use pendalf89\tree\TreeWidget;

/* @var $this yii\web\View */
/* @var $models array */

$this->title = Module::t('main', 'Category tree');
$this->params['breadcrumbs'][] = ['label' => Module::t('main', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="category-index">

    <h1><?= $this->title ?></h1>

    <?= TreeWidget::widget([
        'models' => $models,
        'value' => function($model) {
                return $model->title;
            }
    ]) ?>

</div>
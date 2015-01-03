<?php

use pendalf89\blog\Module;
use pendalf89\tree\TreeWidget;

/* @var $this yii\web\View */
/* @var $models array */
/* @var $model pendalf89\blog\models\Category */

$this->title = Module::t('main', 'Category tree');
$this->params['breadcrumbs'][] = ['label' => Module::t('main', 'Blog'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => Module::t('main', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="category-index">

    <h1><?= $this->title ?></h1>

    <?php $data = TreeWidget::widget([
        'models' => $models,
        'value' => function($model) {
                return $model->title;
            }
    ]) ?>

    <?= \talma\widgets\JsTree::widget([
        'attribute' => 'title',
        'model' => $model,
        'core' => ['data' => $data],
        'plugins' => ['dnd', 'contextmenu', 'wholerow', 'state'],
    ]); ?>

</div>
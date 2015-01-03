<?php

use yii\helpers\Html;
use pendalf89\blog\Module;

/* @var $this yii\web\View */
/* @var $model pendalf89\blog\models\Category */

$this->title = Module::t('main', 'Update category “{title}”', ['title' => $model->title]);
$this->params['breadcrumbs'][] = ['label' => Module::t('main', 'Blog'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => Module::t('main', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('main', 'Update category');
?>
<div class="category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

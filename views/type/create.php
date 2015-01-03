<?php

use yii\helpers\Html;
use pendalf89\blog\Module;

/* @var $this yii\web\View */
/* @var $model pendalf89\blog\models\Type */

$this->title = Module::t('main', 'New post type');
$this->params['breadcrumbs'][] = ['label' => Module::t('main', 'Blog'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => Module::t('main', 'Post types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

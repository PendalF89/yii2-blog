<?php

use yii\helpers\Html;
use pendalf89\blog\Module;
use pendalf89\blog\helpers\Helper;
use kartik\alert\Alert;

/* @var $this yii\web\View */
/* @var $model pendalf89\blog\models\Post */

$this->title = Module::t('main', 'Update post “{title}”', ['title' => $model->title]);
$this->params['breadcrumbs'][] = ['label' => Module::t('main', 'Blog'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => Module::t('main', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('main', 'Update post');
?>
<div class="post-update">

    <?php if (Yii::$app->session->getFlash('postSaved')) : ?>
        <?= Alert::widget([
            'type' => Alert::TYPE_SUCCESS,
            'title' => Module::t('main', 'Post “{title}” has been saved successfully!', [
                    'title' => $model->title,
                ]),
            'icon' => 'glyphicon glyphicon-ok-sign',
            'body' => Module::t('main', 'You can watch this post {on the site}, or go to see {all posts}.', [
                    'on the site' => Html::a(
                            Helper::strtolower(Module::t('main', 'On the site')),
                            $this->context->getViewPostUrl($model),
                            ['target' => '_blank']
                        ),
                    'all posts' => Html::a(Helper::strtolower(Module::t('main', 'All posts')), ['post/index']),
                ]),
            'showSeparator' => true,
        ]); ?>
    <?php else : ?>
        <h1><?= Html::encode($this->title) ?></h1>
    <?php endif; ?>

    <?= $this->render('_form', ['model' => $model]) ?>

</div>

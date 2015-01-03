<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use pendalf89\blog\Module;
use pendalf89\blog\helpers\Helper;

/* @var $this yii\web\View */
/* @var $model pendalf89\blog\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('main', 'Blog'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => Module::t('main', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(
            '<span class="glyphicon glyphicon-eye-open"></span> ' . Module::t('main', 'View post on the site'),
            $viewPostUrl,
            ['target' => '_blank', 'class' => 'btn btn-info']
        ); ?>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> ' . Module::t('main', 'Update'),
            ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> ' . Module::t('main', 'Delete'),
            ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'category_id',
                'value' => !empty($model->category) ? $model->category->title : null,
            ],
            [
                'attribute' => 'type_id',
                'value' => $model->type->title,
            ],
            'title',
            'title_seo',
            'alias',
            [
                'attribute' => 'content',
                'value' => Helper::cutStr($model->content),
            ],
            [
                'attribute' => 'preview',
                'value' => Helper::cutStr($model->preview),
            ],
            [
                'attribute' => 'meta_description',
                'value' => !empty($model->meta_description) ? $model->meta_description : null,
            ],
            'views',
            [
                'attribute' => 'publish_status',
                'value' => $model->getStatus(),
            ],
            [
                'attribute' => 'created_at',
                'value' => Yii::$app->formatter->asDatetime($model->created_at),
            ],
            [
                'attribute' => 'updated_at',
                'value' => !empty($model->updated_at)
                        ? Yii::$app->formatter->asDatetime($model->updated_at)
                        : null,
            ],
        ],
    ]) ?>
</div>
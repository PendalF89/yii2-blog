<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use pendalf89\blog\Module;
use pendalf89\blog\helpers\Helper;

/* @var $this yii\web\View */
/* @var $model pendalf89\blog\models\Type */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('main', 'Blog'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => Module::t('main', 'Post types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
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
            'title',
            'alias',
            [
                'attribute' => 'show_category',
                'value' => Helper::booleanChoiceArray()[$model->show_category],
            ],
        ],
    ]) ?>

</div>

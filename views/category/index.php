<?php

use yii\helpers\Html;
use yii\grid\GridView;
use pendalf89\blog\Module;
use pendalf89\blog\models\Category;

/* @var $this yii\web\View */
/* @var $searchModel pendalf89\blog\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('main', 'Categories');
$this->params['breadcrumbs'][] = ['label' => Module::t('main', 'Blog'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Module::t('main', 'New category'),
            ['create'], ['class' => 'btn btn-success']) ?>

        <?= Html::a('<span class="glyphicon glyphicon-tree-deciduous"></span> ' . Module::t('main', 'Category tree'),
            ['tree'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'parent_id',
                'value' => function ($model) {
                       return $model->getParentTitle();
                    },
                'filter' => Category::getList(),
            ],
            'title',
            'alias',
            'position',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

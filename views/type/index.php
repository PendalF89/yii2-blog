<?php

use yii\helpers\Html;
use yii\grid\GridView;
use pendalf89\blog\Module;
use pendalf89\blog\helpers\Helper;

/* @var $this yii\web\View */
/* @var $searchModel pendalf89\blog\models\TypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('main', 'Post types');
$this->params['breadcrumbs'][] = ['label' => Module::t('main', 'Blog'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Module::t('main', 'New post type'),
            ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'title',
            'alias',
            [
                'attribute' => 'show_category',
                'format' => 'html',
                'value' => function($model) {
                        return Helper::booleanIconChoiceArray()[$model->show_category];
                    },
                'filter' => Helper::booleanChoiceArray(),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

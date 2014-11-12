<?php

use yii\helpers\Html;
use yii\grid\GridView;
use pendalf89\blog\Module;
use pendalf89\blog\models\Post;
use pendalf89\blog\models\Type;
use pendalf89\blog\models\Category;
use pendalf89\blog\helpers\Helper;
use pendalf89\blog\assets\BlogAsset;

/* @var $this yii\web\View */
/* @var $searchModel pendalf89\blog\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('main', 'Posts');
$this->params['breadcrumbs'][] = ['label' => Module::t('main', 'Blog'), 'url' => ['/blog/default/index']];
$this->params['breadcrumbs'][] = $this->title;

BlogAsset::register($this);
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-4">
            <?= $this->render('_new', ['model' => $model]) ?>
        </div>
        <div class="col-md-8">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'title',
                'format' => 'html',
                'value' => function($model) {
                        return Html::a($model->title, ['/blog/post/update', 'id' => $model->id]);
                    },
            ],
            [
                'attribute' => 'category_id',
                'value' => function($model) {
                        return !empty($model->category) ? $model->category->title : null;
                    },
                'filter' => Category::getList(),
            ],
            [
                'attribute' => 'type_id',
                'value' => function($model) {
                        return $model->type->title;
                    },
                'filter' => Type::getList(),
            ],
            [
                'attribute' => 'meta_description',
                'format' => 'html',
                'value' => function($model) {
                        $metaDecriptionStatus = !empty($model->meta_description)
                            ? 1 : 0;
                        return Helper::booleanIconChoiceArray()[$metaDecriptionStatus];
                    },
                'filter' => ['yes' => Yii::t('yii', 'Yes'), 'no' => Yii::t('yii', 'No')],
            ],
             'views',
            [
                'attribute' => 'publish_status',
                'value' => function($model) {
                        return $model->getStatus();
                    },
                'filter' => Post::getStatuses(),
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
                'buttons' => [
                    'view' => function($url, $model) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-eye-open"></span>',
                                $this->context->getViewPostUrl($model),
                                ['target' => '_blank', 'title' => Module::t('main', 'View post on the site')]
                            );
                        }
                ]
            ],
        ],
    ]); ?>

</div>

<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use pendalf89\blog\models\Post;
use pendalf89\blog\Module;
use kartik\typeahead\Typeahead;

/* @var $this yii\web\View */
/* @var $model pendalf89\blog\models\PostSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-warning">
    <div class="panel-heading"><?= Module::t('main', 'Post search') ?></div>
    <div class="panel-body">

        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'layout' => 'inline'
        ]); ?>

            <?= $form->field($model, 'title')->widget(Typeahead::classname(), [
                'options' => ['placeholder' => Module::t('main', 'Enter post title...')],
                'pluginOptions' => ['highlight' => true],
                'dataset' => [['local' => $titles]]
            ]); ?>

            <?= Html::submitButton('<span class="glyphicon glyphicon-search"></span> '
                . Module::t('main', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<span class="glyphicon glyphicon-remove text-danger"></span>', ['post/index'], ['class' => 'btn btn-default']) ?>

        <?php ActiveForm::end(); ?>

    </div>
</div>
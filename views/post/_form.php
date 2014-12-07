<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use pendalf89\blog\models\Category;
use pendalf89\blog\models\Post;
use pendalf89\blog\assets\BlogAsset;
use pendalf89\blog\Module;
use pendalf89\filemanager\widgets\FileInput;
use pendalf89\filemanager\widgets\TinyMCE;

/* @var $this yii\web\View */
/* @var $model pendalf89\blog\models\Post */
/* @var $form yii\widgets\ActiveForm */

BlogAsset::register($this);
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <!--Left column START-->
        <div class="col-md-9 panel-default">
            <div class="panel panel-default">
                <div class="panel-body">

                    <?= $form->field($model, 'title')->textInput(['maxlength' => 255,
                        'class' => 'form-control translit-input duplicate-input']) ?>

                    <?= $form->field($model, 'title_seo')->textInput(['maxlength' => 255,
                        'class' => 'form-control duplicate-output']) ?>

                    <?= $form->field($model, 'content')->widget(TinyMCE::className(), [
                        'clientOptions' => $this->context->module->editorOptions,
                    ]); ?>

                    <?= $form->field($model, 'preview')->widget(TinyMCE::className(), [
                        'clientOptions' => $this->context->module->editorOptions,
                    ]); ?>

                    <?= $form->field($model, 'meta_description')->textarea(['rows' => 6]) ?>

                </div>
            </div>
        </div>
        <!--Left column END-->

        <!--Right column START-->
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">

                    <div id="thumbnail-container"><?= $model->getThumbnailImage('original') ?></div>

                    <?= $form->field($model, 'thumbnail')->widget(FileInput::className(), [
                        'thumb' => 'original',
                        'template' => '<div class="input-group">{input}<span class="btn-group">{button}{reset-button}</span></div>',
                        'pasteData' => FileInput::DATA_ID,
                        'buttonName' => Module::t('main', 'Set thumbnail'),
                        'imageContainer' => '#thumbnail-container',
                    ]) ?>

                    <?= $form->field($model, 'publish_status')->dropDownList(Post::getStatuses()) ?>

                    <?php if ($model->type->show_category) : ?>
                        <?= $form->field($model, 'category_id')->dropDownList(Category::getList()) ?>
                    <?php endif; ?>

                    <?= $form->field($model, 'alias')->textInput(['maxlength' => 255, 'class' => 'form-control translit-output']) ?>

                    <?= $form->field($model, 'views')->textInput() ?>

                    <?php if (!$model->isNewRecord) : ?>
                        <p>
                            <div class="btn-group">
                                <?= Html::submitButton(
                                    Module::t('main', 'Save'),
                                    ['class' =>'btn btn-primary btn-sm']
                                ) ?>
                                <?= Html::a(
                                    Module::t('main', 'View on the site'),
                                    $this->context->getViewPostUrl($model),
                                    ['class' => 'btn btn-warning btn-sm', 'target' => '_blank']
                                ) ?>
                            </div>
                        </p>

                        <?= Html::a(
                            '<span class="glyphicon glyphicon-info-sign"></span> ' . Module::t('main', 'Detail info'),
                            ['/blog/post/view', 'id' => $model->id],
                            ['class' => 'btn btn-default btn-sm']
                        ) ?>

                    <?php else : ?>

                        <?= Html::submitButton(Module::t('main', 'Save'), ['class' => 'btn btn-success btn-sm']) ?>

                    <?php endif; ?>

                </div>
                <?php if (!$model->isNewRecord) : ?>

                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td>
                                <span class="glyphicon glyphicon-time"></span>
                                <span class="glyphicon glyphicon-plus text-success"></span>
                            </td>
                            <td><?= Yii::$app->formatter->asDatetime($model->created_at) ?></td>
                        </tr>
                        <?php if (!empty($model->updated_at)) : ?>
                            <tr>
                                <td>
                                    <span class="glyphicon glyphicon-time"></span>
                                    <span class="glyphicon glyphicon-pencil text-warning"></span>
                                </td>
                                <td><?= Yii::$app->formatter->asDatetime($model->updated_at) ?></td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>

                <?php endif; ?>
            </div>
        </div>
        <!--Right column END-->
    </div>

    <?php ActiveForm::end(); ?>

</div>
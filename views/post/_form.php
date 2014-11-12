<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use pendalf89\blog\models\Category;
use pendalf89\blog\models\Post;
use pendalf89\blog\Module;
use maybeworks\tinymce\TinyMceWidget;
use mihaildev\elfinder\ElFinder;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model pendalf89\blog\models\Post */
/* @var $form yii\widgets\ActiveForm */
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

                    <?= $form->field($model, 'content')->widget(CKEditor::className(), [
                        'editorOptions' => ElFinder::ckeditorOptions('elfinder', $this->context->module->editorOptions),
                    ]); ?>

                    <?= $form->field($model, 'preview')->widget(CKEditor::className(), [
                        'editorOptions' => ElFinder::ckeditorOptions('elfinder', $this->context->module->editorOptions),
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

                    <?= $form->field($model, 'publish_status')->dropDownList(Post::getStatuses()) ?>

                    <?php if ($model->type->show_category) : ?>
                        <?= $form->field($model, 'category_id')->dropDownList(Category::getList()) ?>
                    <?php endif; ?>

                    <?= $form->field($model, 'views')->textInput() ?>

                    <?= $form->field($model, 'alias')->textInput(['maxlength' => 255, 'class' => 'form-control translit-output']) ?>

                    <?= $form->field($model, 'thumbnail')->textarea(['rows' => 6]) ?>

                    <?= Html::submitButton($model->isNewRecord
                        ? Module::t('main', 'Save')
                        : Module::t('main', 'Update'),
                        ['class' => $model->isNewRecord
                            ? 'btn btn-success'
                            : 'btn btn-primary']) ?>
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

<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use pendalf89\blog\Module;
use pendalf89\blog\models\Type;

/* @var $this yii\web\View */
/* @var $model pendalf89\blog\models\PostSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading"><?= Module::t('main', 'New post') ?></div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'action' => ['/blog/post/create'],
                    'method' => 'get',
                    'layout' => 'inline'
                ]); ?>

                <?= $form->field($model, 'type_id', [
                    'inputTemplate' => '<div class="input-group"><span class="input-group-addon">'
                        . Module::t('main', 'Post type') . '</span>{input}</div>',
                ])->dropDownList(Type::getList()) ?>

                <div class="form-group">
                    <?= Html::submitButton('<span class="glyphicon glyphicon-plus"></span> '
                        . Module::t('main', 'Add'),
                        ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
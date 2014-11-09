<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use pendalf89\blog\Module;
use pendalf89\blog\models\Category;

/* @var $this yii\web\View */
/* @var $model pendalf89\blog\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'parent_id')->dropDownList(Category::getList($model->id),
        ['prompt' => Module::t('main', 'Select parent category')]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'position')
        ->textInput()
        ->hint(Module::t('main', 'Number of position on sorting. The higher the number, the higher category is to issue.')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Module::t('main', 'Create')
            : Module::t('main', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

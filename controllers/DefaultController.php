<?php

namespace pendalf89\blog\controllers;

use pendalf89\blog\models\Post;
use Yii;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSettings()
    {
        return $this->render('settings');
    }

    /**
     * Thumbnails resize
     */
    public function actionResize()
    {
        $models = Post::find()->onCondition(['!=', 'thumbnails', ''])->all();
        $presets = $this->module->thumbnails;

        foreach ($models as $model) {
            $model->deleteThumbnails();
            $model->createThumbnails($presets);
            $model->save();
        }

        Yii::$app->session->setFlash('successResize');
        $this->redirect('settings');
    }
}

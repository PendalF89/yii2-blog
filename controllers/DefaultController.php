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
}

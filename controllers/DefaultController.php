<?php

namespace pendalf89\blog\controllers;

use pendalf89\filemanager\assets\FilemanagerAsset;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}

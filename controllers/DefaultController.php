<?php

namespace pendalf89\blog\controllers;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}

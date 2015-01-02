<?php

namespace pendalf89\blog\controllers;

use yii\filters\VerbFilter;
use Yii;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class Controller extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
}
<?php

namespace pendalf89\blog;

use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'pendalf89\blog\controllers';

    public function init()
    {
        parent::init();
        // Yii::$app->db->tablePrefix = 'blog_';
        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['modules/blog/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => 'vendor/pendalf89/yii2-blog/messages',
            'fileMap' => [
                'modules/showcase/main' => 'main.php',
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t("modules/blog/$category", $message, $params, $language);
    }
}

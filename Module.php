<?php

namespace pendalf89\blog;

use Yii;

/**
 * Blog module class.
 *
 * @author Zabolotskikh Boris <zabolotskich@bk.ru>
 */
class Module extends \yii\base\Module
{
    /**
     * If true, entered title on create will be translited from
     * russian symbols to english automatically on fly.
     *
     * @var bool auto translit switch.
     */
    public $autoTranslit = false;

    public $controllerNamespace = 'pendalf89\blog\controllers';

    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['modules/blog/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@vendor/pendalf89/yii2-blog/messages',
            'fileMap' => [
                'modules/blog/main' => 'main.php',
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t("modules/blog/$category", $message, $params, $language);
    }
}

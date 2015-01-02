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
    public $controllerNamespace = 'pendalf89\blog\controllers';

    /**
     * If true, entered title on create will be translited from
     * russian symbols to english automatically on fly.
     *
     * @var bool auto translit switch.
     */
    public $autoTranslit = false;

    /**
     * @var array options for TinyMCE editor.
     * @see http://www.tinymce.com/wiki.php/Plugins
     */
    public $editorOptions = [
        'language' => 'ru',
        'menubar' => false,
        'height' => 500,
        'image_dimensions' => false,
        'plugins' => [
            'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code contextmenu table',
        ],
        'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
    ];

    /**
     * @var string callback function for create post view url. Have $model argument.
     */
    public $viewPostUrlCallback = '';

    public function init()
    {
        parent::init();
        $this->setDefaultViewPostUrlCallback();
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
        if (!isset(Yii::$app->i18n->translations['modules/blog/*'])) {
            return $message;
        }

        return Yii::t("modules/blog/$category", $message, $params, $language);
    }

    private function setDefaultViewPostUrlCallback()
    {
        if (empty($this->viewPostUrlCallback)) {
            $this->viewPostUrlCallback = function ($model) {
                return '#please_set_view_post_url_callback ' . $model->alias;
            };
        }
    }
}

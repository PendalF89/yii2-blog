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
     * Documentation here: http://ckeditor.com/latest/samples/plugins/toolbar/toolbar.html
     *
     * @var array options for CKEDitor editor.
     */
    public $editorOptions = [
        'toolbar' => [
            ['items' => [
                'Source',
                '-',
                'Undo',
                'Redo',
                'Bold',
                'Italic',
                'Underline',
                'Strike',
                '-',
                'RemoveFormat',
                'NumberedList',
                'BulletedList',
                '-',
                'JustifyLeft',
                'JustifyCenter',
                'JustifyRight',
                'JustifyBlock',
                '-',
                'Blockquote',
                '-',
                'Link',
                'Unlink',
                '-',
                'Image',
                'Table',
                'ShowBlocks',
                'PasteFromWord',
                'Format',
            ]],
        ],
    ];

    /**
     * @var string callback function for create post view url. Have $model argument.
     */
    public $viewPostUrlCallback = '';

    /**
     * @var array thumbnails names and sizes, for example: ['small' => [100, 100], 'medium' => [250, 250]]
     */
    public $thumbnails = [];

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

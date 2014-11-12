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

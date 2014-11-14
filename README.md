yii2-blog
=========

Yii2 blog module
Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist pendalf89/yii2-blog "*"
```

or add

```
"pendalf89/yii2-blog": "*"
```

to the require section of your `composer.json` file.

Apply migration
```sh
yii migrate --migrationPath=vendor/pendalf89/yii2-blog/migrations
```

Configuration:

```php
'modules' => [
    'blog' => [
        'class' => 'pendalf89\blog\Module',
        // This option automatically translit entered titles 
        // from russian symbols to english on fly. Default false.
        'autoTranslit' => true, 
        // Some options for CKEditor. Default custom options.
        'editorOptions' => [],
        // callback function for create post view url. Have $model argument.
        'viewPostUrlCallback' => function($model) {
                return '/' . $model->alias;
            },
        // Thumbnails presets
        'thumbnails' => [
            'small' => [80, 50],
            'medium' => [100, 100],
            'large' => [250, 200],
        ],
        // Thumbnail preset, which using in admin view
        'adminThumbnail' => 'small',
        // Access rules array, using for yii\filters\AccessControl filter.
        'accessRules' => [
            [
                'allow' => true,
                'roles' => ['@'],
            ],
    ],
],
```

Don't forget configure controllerMap for ElFinder. See how to do this on [MihailDev/yii2-elfinder](https://github.com/MihailDev/yii2-elfinder) extension page.

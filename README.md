yii2-blog
=========

Yii2 blog module
Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).
Add repositories info for original responsive filemanager repository.

`composer.json` file:

```
"require": {
    "pendalf89/yii2-blog": "*"
},
"repositories": [
        {
            "type": "package",
            "package": {
                "name": "trippo/responsivefilemanager",
                "version": "dev-master",
                "source": {
                    "type": "git",
                    "url": "https://github.com/trippo/responsivefilemanager",
                    "reference": "master"
                }
            }
        }
    ]
```

Apply migration
```sh
yii migrate --migrationPath=vendor/pendalf89/yii2-blog/migrations
```

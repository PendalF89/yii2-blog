<?php

namespace pendalf89\blog\models;

use Yii;
use pendalf89\blog\Module;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\imagine\Image;

/**
 * This is the model class for table "blog_post".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $type_id
 * @property string $title
 * @property string $title_seo
 * @property string $alias
 * @property string $meta_description
 * @property string $preview
 * @property string $content
 * @property integer $views
 * @property integer $publish_status
 * @property string $thumbnails
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Category $category
 * @property Type $type
 */
class Post extends ActiveRecord
{
    const STATUS_PUBLISHED = 1;
    const STATUS_DRAFT = 0;

    /**
     * @var string url for original thumbnail image
     */
    public $original_thumbnail = '';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'type_id', 'publish_status', 'created_at', 'updated_at'], 'integer'],
            [['type_id', 'title', 'title_seo', 'alias', 'preview', 'content'], 'required'],
            [['meta_description', 'preview', 'content', 'thumbnails', 'original_thumbnail'], 'string'],
            [['title', 'title_seo', 'alias'], 'string', 'max' => 255],
            ['category_id', 'required', 'on' => 'required_category'],
            ['thumbnails', 'default', 'value' => ''],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => Module::t('main', 'Category'),
            'type_id' => Module::t('main', 'Type'),
            'title' => Module::t('main', 'Title'),
            'title_seo' => Module::t('main', 'SEO title'),
            'alias' => Module::t('main', 'Alias'),
            'meta_description' => Module::t('main', 'Meta description'),
            'preview' => Module::t('main', 'Preview'),
            'content' => Module::t('main', 'Content'),
            'views' => Module::t('main', 'Views'),
            'publish_status' => Module::t('main', 'Publish Status'),
            'thumbnails' => Module::t('main', 'Thumbnails'),
            'original_thumbnail' => Module::t('main', 'Thumbnail'),
            'created_at' => Module::t('main', 'Created at'),
            'updated_at' => Module::t('main', 'Updated at'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
            ]
        ];
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->original_thumbnail = $this->getOriginalThumbnail();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }

    /**
     * @return string status
     */
    public function getStatus()
    {
        $statuses = self::getStatuses();
        return $statuses[$this->publish_status];
    }

    /**
     * @return boolean thumbnails
     */
    public function getThumbnails()
    {
        return unserialize($this->thumbnails);
    }

    /**
     * @return boolean thumbnail by preset name (see presets in module configuration)
     */
    public function getThumbnail($presetName)
    {
        $thumbnails = $this->getThumbnails();
        return !empty($thumbnails[$presetName]) ? $thumbnails[$presetName] : '' ;
    }

    /**
     * @return string original thumbnail
     */
    public function getOriginalThumbnail()
    {
        return $this->getThumbnail('original');
    }

    /**
     * @return int last changes timestamp
     */
    public function getLastChangesTimestamp()
    {
        return !empty($this->updated_at) ? $this->updated_at : $this->created_at;
    }

    /**
     * This method create thumbnails by original thumbnail path ($this->thumbnails)
     * and use thumbnails presets (they are in Blog module configuration).
     *
     * @param array $presets configuration for thumbnails like ['small' => [100, 100], 'medium' => [250, 250]]
     * @return string|boolean serialized thumbnails array
     */
    public function createThumbnails(array $presets)
    {
        $originalThumbPath = $this->original_thumbnail;

        if (!file_exists(Yii::getAlias("@webroot$originalThumbPath"))) {
            return false;
        }

        $thumbInfo = pathinfo($originalThumbPath);
        $filename = $thumbInfo['filename'];
        $extension = $thumbInfo['extension'];
        $dirname = $thumbInfo['dirname'];
        $thumbnails = ['original' => $originalThumbPath];

        Image::$driver = [Image::DRIVER_GD2, Image::DRIVER_GMAGICK, Image::DRIVER_IMAGICK];

        foreach ($presets as $presetName => $sizes) {
            $width = $sizes[0];
            $height = $sizes[1];
            $relativePath = "$dirname/$filename-{$width}x{$height}.$extension";

            Image::thumbnail("@webroot$originalThumbPath", $width, $height)
                ->save(Yii::getAlias("@webroot$relativePath"));

            $thumbnails[$presetName] = $relativePath;
        }

        return $this->thumbnails = serialize($thumbnails);
    }

    /**
     * Delete all thumbnails for this model except original thumbnail
     * @return array deleted thumbnails names
     */
    public function deleteThumbnails()
    {
        $deletedFileNames = [];
        $thumbnails = $this->getThumbnails();
        unset($thumbnails['original']);

        foreach ($thumbnails as $key => $path) {
            $fileName = Yii::getAlias("@webroot$path");

            if (file_exists($fileName) && unlink($fileName)) {
                $deletedFileNames[] = $path;
            }
        }

        return $deletedFileNames;
    }

    /**
     * Check whether thumbnail by other posts.
     * @return bool
     */
    public function isThumbnailUseInOtherPosts()
    {
        if (self::find()
            ->where(['!=', 'id', $this->id])
            ->andWhere(['thumbnails' => $this->thumbnails])
            ->all()) {
            return true;
        }
            return false;
    }

    /**
     * @return array statuses
     */
    public static function getStatuses()
    {
        return [
            self::STATUS_DRAFT => Module::t('main', 'Draft'),
            self::STATUS_PUBLISHED => Module::t('main', 'Published'),
        ];
    }

    /**
     * @return array titles list
     */
    public static function getTitlesList()
    {
        $titles = [];

        foreach (self::find()->all() as $model) {
            $titles[] = $model->title;
        }

        return $titles;
    }
}

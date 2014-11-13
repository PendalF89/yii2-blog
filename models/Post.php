<?php

namespace pendalf89\blog\models;

use Yii;
use pendalf89\blog\Module;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

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
            [['meta_description', 'preview', 'content', 'thumbnails'], 'string'],
            [['title', 'title_seo', 'alias'], 'string', 'max' => 255],
            ['category_id', 'required', 'on' => 'required_category'],
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
        return self::getStatuses()[$this->publish_status];
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

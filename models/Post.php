<?php

namespace pendalf89\blog\models;

use Yii;
use pendalf89\blog\Module;

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
 * @property string $thumbnail
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Category $category
 * @property Type $type
 */
class Post extends \yii\db\ActiveRecord
{
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
            [['category_id', 'type_id', 'views', 'publish_status', 'created_at', 'updated_at'], 'integer'],
            [['type_id', 'title', 'title_seo', 'alias', 'preview', 'content', 'created_at'], 'required'],
            [['meta_description', 'preview', 'content', 'thumbnail'], 'string'],
            [['title', 'title_seo', 'alias'], 'string', 'max' => 255]
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
            'thumbnail' => Module::t('main', 'Thumbnail'),
            'created_at' => Module::t('main', 'Created at'),
            'updated_at' => Module::t('main', 'Updated at'),
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
}

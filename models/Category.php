<?php

namespace pendalf89\blog\models;

use Yii;
use pendalf89\blog\Module;

/**
 * This is the model class for table "blog_category".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $title
 * @property string $alias
 * @property integer $position
 *
 * @property Post[] $posts
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'position'], 'integer'],
            [['title', 'alias'], 'required'],
            [['title', 'alias'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => Module::t('main', 'Parent category'),
            'title' => Module::t('main', 'Title'),
            'alias' => Module::t('main', 'Alias'),
            'position' => Module::t('main', 'Position'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['category_id' => 'id']);
    }

    /**
     * @return null|string parent title
     */
    public function getParentTitle()
    {
        $model = Category::findOne($this->parent_id);

        return !empty($model) ? $model->title : null;
    }

    /**
     * Gets a list of all the models.
     * Can be used as array in yii\widgets\ActiveForm dropDownList().
     *
     * @param int $excludeId ignoring model with this id
     * @return array list of all models.
     */
    public static function getList($excludeId = 0)
    {
        $list = [];
        $query = self::find()->orderBy('position DESC, title');

        if (!empty($excludeId)) {
            $query->where('`id` != :excludeId', ['excludeId' => $excludeId]);
        }

        $models = $query->all();

        foreach ($models as $model) {
            $list[$model->id] = $model->title;
        }

        return $list;
    }
}

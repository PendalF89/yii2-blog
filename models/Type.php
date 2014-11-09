<?php

namespace pendalf89\blog\models;

use Yii;
use pendalf89\blog\Module;

/**
 * This is the model class for table "blog_type".
 *
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property integer $show_category
 *
 * @property Post[] $posts
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'alias'], 'required'],
            [['show_category'], 'integer'],
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
            'title' => Module::t('main', 'Title'),
            'alias' => Module::t('main', 'Alias'),
            'show_category' => Module::t('main', 'Show Category'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['type_id' => 'id']);
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
        $query = self::find()->orderBy('title');

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

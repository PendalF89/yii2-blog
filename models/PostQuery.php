<?php
namespace pendalf89\blog\models;

use yii\db\ActiveQuery;

class PostQuery extends ActiveQuery
{
    /**
     * Published posts scope
     *
     * @return $this
     */
    public function published()
    {
        $this->andWhere(['blog_post.publish_status' => Post::STATUS_PUBLISHED]);
        return $this;
    }

    /**
     * Posts by type
     *
     * @param string $type
     * @return $this
     */
    public function type($type)
    {
        $this->joinWith(['type']);
        $this->andWhere(['blog_type.alias' => $type]);
        return $this;
    }

    /**
     * Posts by category
     *
     * @param string $category
     * @return $this
     */
    public function category($category)
    {
        $this->joinWith(['category']);
        $this->andWhere(['blog_category.alias' => $category]);
        return $this;
    }

    /**
     * Posts by alias
     *
     * @param string $alias
     * @return $this
     */
    public function alias($alias)
    {
        $this->andWhere(['blog_post.alias' => $alias]);
        return $this;
    }
}
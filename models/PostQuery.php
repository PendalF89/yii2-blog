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
        $this->andWhere(['publish_status' => Post::STATUS_PUBLISHED]);
        return $this;
    }
}
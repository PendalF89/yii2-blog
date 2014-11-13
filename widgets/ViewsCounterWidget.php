<?php

namespace pendalf89\blog\widgets;

/**
 * Class ViewCounterWidget
 *
 * Counts and return the number of views post on the each load.
 * Just place this widget on the page of post and specify Post $model.
 *
 * @author Zabolotskikh Boris <zabolotskich@bk.ru>
 */
class ViewsCounterWidget extends \yii\base\Widget
{
    /**
     * @var \pendalf89\blog\models\Post null Post model
     */
    public $model = null;

    public function run()
    {
        ++$this->model->views;
        $this->model->detachBehavior('timestamp');
        $this->model->save();

        return $this->model->views;
    }
}

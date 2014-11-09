<?php

namespace pendalf89\blog\helpers;

use Yii;

class Helper
{
    /**
     * @return array simple "yes/no" array
     */
    public static function booleanChoiceArray()
    {
        return [1 => Yii::t('yii', 'Yes'), 0 => Yii::t('yii', 'No')];
    }

    /**
     * @return array icon "yes/no" array
     */
    public static function booleanIconChoiceArray()
    {
        return [
            1 => '<span class="glyphicon glyphicon-ok text-success"></span>',
            0 => '<span class="glyphicon glyphicon-remove text-danger"></span>',
        ];
    }
}

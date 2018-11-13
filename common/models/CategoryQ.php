<?php

namespace common\models;

use yii\db\ActiveQuery;
//use paulzi\nestedsets\NestedSetsQueryTrait;
use creocoder\nestedsets\NestedSetsQueryBehavior;

class CategoryQ extends ActiveQuery
{
    public function behaviors()
    {
        return [
            NestedSetsQueryBehavior::className(),
        ];
    }
}
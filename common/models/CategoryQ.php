<?php
/**
 * Created by PhpStorm.
 * User: Анна
 * Date: 07.11.2018
 * Time: 9:01
 */

namespace common\models;

use yii\db\ActiveQuery;
use paulzi\nestedsets\NestedSetsQueryTrait;

class CategoryQ extends ActiveQuery
{
    use NestedSetsQueryTrait;

    public function tree()
    {
        $category = Category::find()->with('childrens')->where(['depth'=>0])->all();

    }
}
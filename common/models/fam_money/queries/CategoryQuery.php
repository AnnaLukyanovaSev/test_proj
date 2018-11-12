<?php
/**
 * Created by PhpStorm.
 * User: Анна
 * Date: 07.11.2018
 * Time: 9:01
 */

namespace common\models\fam_money\queries;

use yii\db\ActiveQuery;
use paulzi\nestedsets\NestedSetsQueryTrait;

class CategoryQuery extends ActiveQuery
{
    use NestedSetsQueryTrait;
}
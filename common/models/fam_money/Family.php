<?php

namespace common\models\fam_money;

use yii\db\ActiveRecord;

class Family extends ActiveRecord
{

    public static function create(): self
    {
        $family = new static();
        return $family;
    }

    public static function tableName()
    {
        return 'family';
    }
}
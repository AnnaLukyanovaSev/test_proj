<?php

namespace common\models\fam_money;

use common\models\fam_money\queries\CategoryQ;
use yii\db\ActiveRecord;
use paulzi\nestedsets\NestedSetsBehavior;

class Category extends ActiveRecord
{
    /**
     * @var string $name
     */
    public $name;

    public static function create(string $name): self
    {
        $category = new static();
        $category->name = $name;
        return $category;
    }

    public function edit(string $name): void
    {
        $this->name = $name;
    }

    public static function tableName()
    {
        return 'category';
    }

    public function behaviour()
    {
        return [
            NestedSetsBehavior::classname(),
        ];
    }

    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find(): CategoryQ
    {
        return new CategoryQ(static::class);
    }
}
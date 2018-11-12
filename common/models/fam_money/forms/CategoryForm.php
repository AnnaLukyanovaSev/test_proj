<?php

namespace common\models\fam_money\forms;

use common\models\fam_money\Category;
use yii\base\Model;

class CategoryForm extends Model
{
    /**
     * @var string $name
     */
    public $name;
    public $parent_id;

    public function __construct(Category $category = null, $config = [])
    {
        if ($category) {
            $this->name = $category->name;
            $this->parent_id=$category->parent ? $category->parent->id : null;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['parent_id'], 'integer'],
            ['name', 'required', 'string', 'max' => 255],
            [
                'name',
                'match',
                'pattern' => '/[a-z]*/i',
                'message' => 'Only letters are allowed to input'
            ]
        ];
    }
}

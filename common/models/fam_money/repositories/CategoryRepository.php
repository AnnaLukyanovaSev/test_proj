<?php

namespace common\models\fam_money\repositories;

use common\models\fam_money\Category;

class CategoryRepository
{

    public function get(int $id): Category
    {
        if (!$category = Category::findOne($id)) {
            throw new NotFoundException('Category not found!');
        }
        return $category;
    }

    public function save(Category $category): void
    {
        if (!$category->save()) {
            throw new \RuntimeException('Saving error!');
        }
    }

    public function remove(Category $category): void
    {
        if (!$category->delete()) {
            throw new \RuntimeException('Removing error!');
        }
    }
}
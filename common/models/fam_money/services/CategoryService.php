<?php

namespace common\models\fam_money\services;

use common\models\fam_money\forms\CategoriesForm;
use common\models\fam_money\Category;
use common\models\fam_money\repositories\CategoryRepository;

class CategoryService
{
    private $categories;

    public function __construct(CategoryRepository $categories)
    {
        $this->categories = $categories;
    }

    public function create(CategoriesForm $form): Category
    {
        $parent=$this->categories->get($form->parent_id);
        $category = Category::create($form->name);
        $this->categories->save($category);
        $category->appendTo($parent);
        $this->categories->save($category);
        return $category;
    }

    public function edit($id, CategoriesForm $form): void
    {
        $category = $this->categories->get($id);
        if ($category->isRoot()) {
            throw new \DomainException('Unable to manage the root category');
        }
     //   $this->assertIsNotRoot($category);
        $category->edit(
            $form->name
        );
        $this->categories->save($category);
    }

    public function remove($id): void
    {
        $category = $this->categories->get($id);
        if ($category->isRoot()) {
            throw new \DomainException('Unable to manage the root category');
        }

        $this->categories->remove($category);
    }

}
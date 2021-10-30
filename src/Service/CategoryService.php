<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Category;
use App\Repository\CategoryRepository;

class CategoryService
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function categoryList(): array
    {
        $categories = $this->categoryRepository->findAll();

        return array_map(function(Category $category){
            return $category->getName();
        }, $categories);
    }
}
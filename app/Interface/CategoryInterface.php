<?php

namespace App\Interface;

interface CategoryInterface
{
    public function getAll();
    public function getCategories($search, $limit = 10);
    public function getCategoryDetail($id);
    public function createCategory(array $data);
    public function updateCategory(array $data, $Category);
    public function deleteCategory($categoryId);
}

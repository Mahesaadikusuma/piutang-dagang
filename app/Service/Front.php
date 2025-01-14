<?php

namespace App\Service;

use App\Interface\CategoryInterface;
use App\Interface\ProductInterface;
use App\Repository\ProductRepository;

class Front
{

    protected $productRepository;
    protected $categoryRepository;
    /**
     * Create a new class instance.
     */
    public function __construct(
        ProductInterface $productRepository,
        CategoryInterface $categoryRepository,
    )
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }


    public function getFrontData()
    {
        $products = $this->productRepository->getProductLimit(10);
        $category = $this->categoryRepository->getAll();
        return compact('products', 'category');
    }

    public function getOtherProducts($slug)
    {
        return $this->productRepository->getOtherProducts($slug);
    }
}

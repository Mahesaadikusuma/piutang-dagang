<?php

namespace App\Interface;

interface ProductInterface
{
    public function getAll();
    public function getProductLimit($limit = 10);
    public function getPaginatedProducts($search, $limit = 10);
    public function getProduct($id);
    public function getOtherProducts($slug);
    public function createProduct(array $data);
    public function updateProduct(array $data, $product);
    public function deleteProduct($productId);
}

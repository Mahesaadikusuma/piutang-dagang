<?php

namespace App\Interface;

interface ProductInterface
{
    public function getAll();
    public function getProducts($search, $limit = 10);
    public function getProduct($id);
    public function createProduct(array $data);
    public function updateProduct(array $data, $product);
    public function deleteProduct($productId);
}

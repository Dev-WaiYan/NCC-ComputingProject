<?php

class ProductController
{
    public static function view()
    {
        return "/admin/product/index.php";
    }

    public static function getData() {
        require_once 'services/admin/ProductService.php';
        require_once 'services/admin/CategoryService.php';
        $products = ProductService::getProducts(['order_by' => 'id desc']);
        $categories = CategoryService::getCategories();

        return (object)[
            'products' => is_array($products) ? $products : [],
            'categories' => is_array($categories) ? $categories : []
        ];
    }
    
}

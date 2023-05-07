<?php

class ProductController
{
    public static function view()
    {
        return "/products/index.php";
    }


    public static function getData()
    {
        require_once 'services/common/CategoryService.php';
        $categories = CategoryService::getCategories();
        return (object)['categories' => $categories];
    }
}

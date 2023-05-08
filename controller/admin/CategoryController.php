<?php

class CategoryController
{
    public static function view()
    {
        return "/admin/category/index.php";
    }

    public static function getData() {
        require_once 'services/admin/CategoryService.php';
        $categories = CategoryService::getCategories();

        return (object)['categories' => is_array($categories) ? $categories : []];
    }
    
}

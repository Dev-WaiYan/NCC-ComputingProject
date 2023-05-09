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
        require_once 'services/common/ProductService.php';
        $categories = CategoryService::getCategories();

        $filterCategoryId = 0;
        $searchStr = "";

        if (isset($_REQUEST['category'])) {
            $filterCategoryId = $_REQUEST['category'];
        }

        if (isset($_REQUEST['search'])) {
            $searchStr = $_REQUEST['search'];
        }

        $products = [];

        if ($filterCategoryId !== 0) {
            $products = ProductService::getProducts([
                'order_by' => 'id desc',
                'where' => [
                    'product_category_id' => $filterCategoryId,
                    'name' => "like %$searchStr%"
                ]
            ]);
        } else {
            $products = ProductService::getProducts([
                'order_by' => 'id desc',
                'limit' => 10,
                'where' => [
                    'name' => "like %$searchStr%"
                ]
            ]);
        }

        return (object)['categories' => $categories, 'products' => $products];
    }
}

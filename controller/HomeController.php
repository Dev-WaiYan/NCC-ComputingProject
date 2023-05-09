<?php

class HomeController
{
    public static function view()
    {
        return "/home/index.php";
    }


    public static function getData()
    {
        require_once 'services/common/ProductService.php';
        $latestProducts = ProductService::getProducts(['order_by' => 'id desc', 'limit' => 8]);
        return (object)['latestProducts' => $latestProducts];
    }
}

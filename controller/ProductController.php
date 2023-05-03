<?php

class ProductController
{
    public static function view()
    {
        return "/products/index.php";
    }


    // public static function getData()
    // {
    //     require_once 'services/ReviewService.php';
    //     $latestReviews = ReviewService::getLatestReviews();
    //     return (object)['latestReviews' => $latestReviews];
    // }
}

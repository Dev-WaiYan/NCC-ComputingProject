<?php

class HomeController
{
    public static function view()
    {
        return "/home/index.php";
    }


    // public static function getData()
    // {
    //     require_once 'services/ReviewService.php';
    //     $latestReviews = ReviewService::getLatestReviews();
    //     return (object)['latestReviews' => $latestReviews];
    // }
}

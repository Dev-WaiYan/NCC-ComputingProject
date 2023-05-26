<?php

class FeedbackService
{

    public static function getFeedbacks()
    {

        $result = [];

        try {
            $result = Db::select('customer_product_reviews');
        } catch (Exception $e) {
            die('Error in Feedback Service : ' . $e->getMessage());
        }

        return $result;
    }
}

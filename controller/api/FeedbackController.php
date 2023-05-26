<?php

header('Content-Type: application/json');
class FeedbackController
{
    public static function create()
    {
        try {
            $data = array(
                'customer_id' => $_SESSION['userId'],
                'review' => $_POST['feedbackReview'],
                'product_id' => $_POST['productId']
            );
            FeedbackService::addFeedback($data);

            echo json_encode(array('status' => 'ok', 'error' => ''));
        } catch (Exception $e) {
            echo json_encode(array('status' => 'error', 'error' => $e->getMessage()));
        }
    }
}

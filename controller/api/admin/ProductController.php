<?php

header('Content-Type: application/json');
require_once './utils/FileUploader.php';
class ProductController
{
    public static function show()
    {
        try {
            $product = ProductService::getProduct($_REQUEST['id']);
            echo json_encode(array('status' => 'ok', 'error' => '', 'data' => [
                'product' => $product
            ]));
        } catch (Exception $e) {
            echo json_encode(array('status' => 'error', 'error' => $e->getMessage()));
        }
    }

    public static function add()
    {
        try {
            $uploader = new FileUploader('./storage/uploads');
            $fileName = $uploader->uploadFile($_FILES['coverImgFile']);
            $data = array(
                'name' => $_POST['nName'],
                'price' => $_POST['nPrice'],
                'product_category_id' => $_POST['nCategoryId'],
                'description' => $_POST['nDescription'],
                'short_description' => $_POST['nShortDescription'],
                'cover_img' => 'uploads/' . $fileName
            );
            ProductService::addProduct($data);
            echo json_encode(array('status' => 'ok', 'error' => ''));
        } catch (Exception $e) {
            echo json_encode(array('status' => 'error', 'error' => $e->getMessage()));
        }
    }


    public static function update()
    {
        if (isset($_FILES['coverImgFile'])) {
            $uploader = new FileUploader('./storage/uploads');
            $fileName = $uploader->uploadFile($_FILES['coverImgFile']);
        }

        $data = [
            'name' => $_POST['eName'],
            'price' => $_POST['ePrice'],
            'product_category_id' => $_POST['eCategoryId'],
            'description' => $_POST['eDescription'],
            'short_description' => $_POST['eShortDescription'],
        ];
        
        if (isset($fileName)) {
            $data = array_merge($data, ['cover_img' => 'uploads/' . $fileName]);
        }

        try {
            ProductService::updateProduct($_REQUEST['id'], $data);
            echo json_encode(array('status' => 'ok', 'error' => ''));
        } catch (Exception $e) {
            echo json_encode(array('status' => 'error', 'error' => $e->getMessage()));
        }
    }

    public static function delete()
    {
        try {
            ProductService::deleteProductById($_REQUEST['id']);
            echo json_encode(array('status' => 'ok', 'error' => ''));
        } catch (Exception $e) {
            echo json_encode(array('status' => 'error', 'error' => $e->getMessage()));
        }
    }
}

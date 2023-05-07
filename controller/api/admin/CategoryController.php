<?php

header('Content-Type: application/json');
class CategoryController
{
    public static function show()
    {
        try {
            $category = CategoryService::getCategory($_REQUEST['id']);
            echo json_encode(array('status' => 'ok', 'error' => '', 'data' => [
                'category' => $category
            ]));
        } catch (Exception $e) {
            echo json_encode(array('status' => 'error', 'error' => $e->getMessage()));
        }
    }

    public static function add()
    {
        $data = array(
            'category_name' => $_POST['newCategoryName'],
        );

        try {
            CategoryService::addCategory($data);
            echo json_encode(array('status' => 'ok', 'error' => ''));
        } catch (Exception $e) {
            echo json_encode(array('status' => 'error', 'error' => $e->getMessage()));
        }
    }


    public static function update()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        try {
            CategoryService::updateCategory($_REQUEST['id'], $data);
            echo json_encode(array('status' => 'ok', 'error' => ''));
        } catch (Exception $e) {
            echo json_encode(array('status' => 'error', 'error' => $e->getMessage()));
        }
    }

    public static function delete()
    {
        try {
            CategoryService::deleteCategoryById($_REQUEST['id']);
            echo json_encode(array('status' => 'ok', 'error' => ''));
        } catch (Exception $e) {
            echo json_encode(array('status' => 'error', 'error' => $e->getMessage()));
        }
    }
}

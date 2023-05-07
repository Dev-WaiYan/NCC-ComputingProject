<?php

class CategoryService
{

    public static function getCategories()
    {

        $result = [];

        try {
            $result = Db::select('product_categories');
        } catch (Exception $e) {
            die('Error in Category Service : ' . $e->getMessage());
        }

        return $result;
    }


    public static function getCategory($id)
    {

        $result = null;

        try {
            $result = Db::selectOne('product_categories', ['where' => ['id' => $id]]);
        } catch (Exception $e) {
            die('Error in Category Service : ' . $e->getMessage());
        }

        return $result;
    }

    public static function addCategory($data)
    {
        $lastInsertId = 0;
        try {
            $lastInsertId = Db::insert('product_categories', $data);
        } catch (Exception $e) {
            die('Error in Category Service : ' . $e->getMessage());
        }

        return $lastInsertId;
    }


    public static function updateCategory($id, $data)
    {
        try {
            Db::updateOne('product_categories', $id, [
                'category_name' => $data['editedCategoryName']
            ]);
        } catch (Exception $e) {
            die('Error in Category Service : ' . $e->getMessage());
        }

        return true;
    }
    

    public static function deleteCategoryById($id)
    {
        try {
            Db::deleteOne('product_categories', $id);
        } catch (Exception $e) {
            die('Error in Category Service : ' . $e->getMessage());
        }

        return true;
    }
}

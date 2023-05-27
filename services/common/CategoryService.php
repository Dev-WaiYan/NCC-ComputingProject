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
}

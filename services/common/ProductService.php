<?php

class ProductService
{

    public static function getProducts($conditions = [])
    {

        $result = [];

        try {
            $result = Db::select('products', $conditions);
        } catch (Exception $e) {
            die('Error in Product Service : ' . $e->getMessage());
        }

        return $result;
    }


    public static function getProduct($id)
    {

        $result = null;

        try {
            $result = Db::selectOne('products', ['where' => ['id' => $id]]);
        } catch (Exception $e) {
            die('Error in Product Service : ' . $e->getMessage());
        }

        return $result;
    }
}

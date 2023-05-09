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

    public static function addProduct($data)
    {
        $lastInsertId = 0;
        try {
            $lastInsertId = Db::insert('products', $data);
        } catch (Exception $e) {
            die('Error in Product Service : ' . $e->getMessage());
        }

        return $lastInsertId;
    }


    public static function updateProduct($id, $data)
    {
        try {
            Db::updateOne('products', $id, $data);
        } catch (Exception $e) {
            die('Error in Product Service : ' . $e->getMessage());
        }

        return true;
    }
    

    public static function deleteProductById($id)
    {
        try {
            Db::deleteOne('products', $id);
        } catch (Exception $e) {
            die('Error in Product Service : ' . $e->getMessage());
        }

        return true;
    }
}

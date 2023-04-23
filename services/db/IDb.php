<?php

interface IDb
{
    public static function insert($tableName, $data);
    public static function select($tableName, $conditions);
    public static function updateOne($tableName,$id,$data);
    public static function deleteOne($tableName, $id);
    public static function deleteAll();
}

<?php

require_once 'services/db/IDb.php';

class Db implements IDb
{
    private static $connection;

    static function __constructStatic()
    {
        try {
            self::$connection = self::getConnection();
        } catch (PDOException $e) {
            exit("Error: " . $e->getMessage());
        }
    }

    public static function insert($table, $data)
    {
        if (!empty($data) && is_array($data)) {
            $columnString = implode(',', array_keys($data));
            $valueString = ":" . implode(',:', array_keys($data));
            $sql = "INSERT INTO " . $table . " (" . $columnString . ") VALUES (" . $valueString . ")";

            $query = self::$connection->prepare($sql);
            foreach ($data as $key => $val) {
                $query->bindValue(':' . $key, $val);
            }
            $query->execute();
            $lastInsertId = self::$connection->lastInsertId();
            return $lastInsertId;
        } else {
            die("Insert : Data is empty.");
        }
    }

    /* 
     * Returns rows from the database based on the conditions 
     * @param string name of the table 
     * @param array select, where, order_by, limit and return_type conditions 
     */
    public static function select($table, $conditions = array())
    {
        $sql = 'SELECT ';
        $sql .= array_key_exists("select", $conditions) ? $conditions['select'] : '*';
        $sql .= ' FROM ' . $table;
        if (array_key_exists("where", $conditions)) {
            $sql .= ' WHERE ';
            $i = 0;
            foreach ($conditions['where'] as $key => $value) {
                $pre = ($i > 0) ? ' AND ' : '';
                $sql .= $pre . $key . " = '" . $value . "'";
                $i++;
            }
        }

        if (array_key_exists("order_by", $conditions)) {
            $sql .= ' ORDER BY ' . $conditions['order_by'];
        }

        if (array_key_exists("start", $conditions) && array_key_exists("limit", $conditions)) {
            $sql .= ' LIMIT ' . $conditions['start'] . ',' . $conditions['limit'];
        } elseif (!array_key_exists("start", $conditions) && array_key_exists("limit", $conditions)) {
            $sql .= ' LIMIT ' . $conditions['limit'];
        }

        $query = self::$connection->prepare($sql);
        $query->execute();

        if (array_key_exists("return_type", $conditions) && $conditions['return_type'] != 'all') {
            switch ($conditions['return_type']) {
                case 'count':
                    $data = $query->rowCount();
                    break;
                case 'single':
                    $data = $query->fetch(PDO::FETCH_ASSOC);
                    break;
                default:
                    $data = '';
            }
        } else {
            if ($query->rowCount() > 0) {
                $data = $query->fetchAll();
            }
        }
        return !empty($data) ? $data : null;
    }


    public static function selectOne($table, $conditions = array()) {
        $conditions['limit'] = 1; // Set limit to 1 to get only one row
        $result = self::select($table, $conditions);
        if (!empty($result)) {
            return $result[0]; // Return the first (and only) row
        } else {
            return null;
        }
    }

    public static function updateOne($table, $id, $data)
    {
        if (!empty($data) && is_array($data)) {
            $valueString = "";
            $i = 0;
            foreach ($data as $key => $val) {
                $pre = ($i > 0) ? ', ' : '';
                $valueString .= $pre . $key . " = :" . $key;
                $i++;
            }
            $sql = "UPDATE " . $table . " SET " . $valueString . " WHERE id = :id";
            $query = self::$connection->prepare($sql);
            $query->bindValue(":id", $id);
            foreach ($data as $key => $val) {
                $query->bindValue(':' . $key, $val);
            }
            $query->execute();
            return $query->rowCount();
        } else {
            die("Update : Data is empty.");
        }
    }

    public static function deleteOne($table, $id)
    {
        $sql = "DELETE FROM " . $table . " WHERE id = :id";
        $query = self::$connection->prepare($sql);
        $query->bindValue(":id", $id);
        $query->execute();
        return $query->rowCount();
    }

    public static function deleteAll()
    {
    }

    private static function getConnection($serverName = "localhost", $userName = "root", $password = "", $dbName = "ncc_computing_pj_myshop")
    {
        if (!self::$connection) {
            self::$connection = new PDO("mysql:host=$serverName;dbname=$dbName", $userName, $password);
        }
        return self::$connection;
    }
}

Db::__constructStatic();

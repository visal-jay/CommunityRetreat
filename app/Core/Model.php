<?php
class Model
{
    protected static function getDB()
    {
        //require './DB-implement.php';

        static $db = null;

        if ($db === null) {
            $dsn = 'mysql:host=localhost;dbname=communityretreat_db;charset=utf8';
            $db = new PDO($dsn, "root", "");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
        return $db;
    }


    public static function select($query, $params = [])
    {
        $db = Model::getDB();
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);  
        $result = $stmt->fetchAll();
        return  $result;
    }


    public static function insert($query, $params = [])
    {
        $db = Model::getDB();
        $stmt = $db->prepare($query);
        $stmt->execute($params);
    }
    
}
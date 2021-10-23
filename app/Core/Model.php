<?php

use Stripe\Issuing\Transaction;

class Model
{
    public static function getDB()
    {
        //require './DB-implement.php';

        static $db = null;

        if ($db === null) {
            $dsn = 'mysql:host=localhost;dbname=communityretreat_db;charset=utf8';
            $db = new PDO($dsn, "root","root");
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
    

    public static function beginTransaction(){
        $db = Model::getDB();
        if($db->inTransaction()==false){
            $db->beginTransaction();
        }
    }

    public static function endTransaction(){
        $db= Model::getDB();
        if($db->inTransaction()==true){
            $db->commit();
        }
    }

    public static function rollBack(){
        $db= Model::getDB();
        if($db->inTransaction()==true){
            $db->rollBack();
        }
    }

    
    public static function pagination($table, $no_of_records_per_page,$extrenal_query="", $params = [])
    {
        $query="SELECT COUNT(*) as count FROM " . $table . " " . $extrenal_query; 
        $result = Model::select($query,$params);
        $pagination["no_of_records_per_page"]=$no_of_records_per_page;
        $pagination["pageno"]= isset($_GET["pageno"]) ? $_GET["pageno"] : 1;
        $pagination["offset"]=($pagination["pageno"]-1) * $no_of_records_per_page;
        $pagination["total_pages"]=ceil($result[0]["count"]/$no_of_records_per_page);
        return($pagination);
    }
}
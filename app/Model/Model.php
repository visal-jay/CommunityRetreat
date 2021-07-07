<?php
class Model
{
    protected static function getDB()
    {
        static $db = null;

        if ($db === null) {
            $dsn = 'mysql:host=;dbname=bankofasia;charset=utf8';

            $db = new PDO($dsn, "root", "root");
            // Throw an Exception when an error occurs
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }


        return $db;
    }


    function getPersons()
    {
        $db = Model::getDB();
        $stmt = $db->prepare("SELECT  name, city FROM person");
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return  $result;
    }

    public function select($query)
    {

        $db = Model::getDB();
        $stmt = $db->prepare($query);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return  $result;
    }
}

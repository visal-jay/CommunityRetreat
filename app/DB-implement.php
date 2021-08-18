<?php
$query = file_get_contents("data.sql");

$dsn = 'mysql:host=localhost;charset=utf8';
$db = new PDO($dsn, "root", "root");
if($db==NULL){
     echo "database connection failed";
}
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$stmt = $db->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'mvc'");
if($stmt->fetchColumn()==0){
     $db->exec($query);
}
$db=null;

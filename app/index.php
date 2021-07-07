<?php
function myAutoload($name)
{
    if (file_exists('./Controllers/' . $name . '.php')) {
        require_once './Controllers/' . $name . '.php';
    } else     if (file_exists('./Model/' . $name . '.php')) {
        require_once './Model/' . $name . '.php';
    } else if (file_exists('./View/' . $name . '.php')) {
        require_once './View/' . $name . '.php';
    }
    else{
        echo "wrong";
    }
}

spl_autoload_register('myAutoload');






$url = isset($_GET["url"]) ? $_GET["url"] : "";
$path = explode("/", $url);


$controllerName =$path[0]."Controller";
$action = $path[1];
$c = new $controllerName();
$c-> $action();



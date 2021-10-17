<?php
function autoLoad($name)
{
    if (file_exists('./Controllers/' . $name . '.php')) {
        require_once './Controllers/' . $name . '.php';
    } else     if (file_exists('./Model/' . $name . '.php')) {
        require_once './Model/' . $name . '.php';
    } else if (file_exists('./View/' . $name . '.php')) {
        require_once './View/' . $name . '.php';
    }
    else if (file_exists('./Core/' . $name . '.php')) {
        require_once './Core/' . $name . '.php';
    }
}

spl_autoload_register('autoLoad');

error_reporting(E_ALL);
set_error_handler('ErrorHandler::error');
set_exception_handler('ErrorHandler::exception');

$lifetime=3600;
session_set_cookie_params($lifetime);
if(!isset($_SESSION)) session_start();

$routing = new Routing();

$routing->process($_SERVER['QUERY_STRING']);



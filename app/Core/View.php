<?php
class View
{
    static function render($view_name,$args=null)
    {
        extract($args, EXTR_SKIP);
        require "./view/$view_name.php";
    }
}
<?php
class View
{
    static function render($view_name,$args=[])
    {
        extract($args, EXTR_SKIP);
        require "./view/$view_name.php";
    }


    static function renderTostring($view_name,$args=[])
    {
        extract($args, EXTR_SKIP);
        ob_start();
        require "./view/$view_name.php";
        $string=ob_get_contents();
        ob_clean();
        return $string;
    }

}
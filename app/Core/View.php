<?php
class View
{
    static function render($view_name,$args=[],$user_roles=[])
    {
        extract($args, EXTR_SKIP);
        extract($user_roles, EXTR_OVERWRITE);
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
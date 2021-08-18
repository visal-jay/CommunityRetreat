<?php
class Controller
{
    public  static function redirect(string $location,$parameters=[])
    {
        $query=http_build_query($parameters);
        header("Location: $location?".$query, true,  301);
        exit();
    }
}


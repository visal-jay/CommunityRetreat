<?php
class Controller
{
    public  static function redirect(string $location,$parameters=[])
    {
        $query=http_build_query($parameters);
        header("Location: $location?".$query, true,  301);
        exit();
    }

    public static function accessCheck($userroles=[]){
        if(!isset($_SESSION))
            session_start();
        if (isset($_SESSION["user"]["user_type"]))
            foreach ($userroles as $userrole)
                if ($userrole == $_SESSION["user"]["user_type"])
                    return $userrole;
        Controller::redirect('/login/view');
    }
}


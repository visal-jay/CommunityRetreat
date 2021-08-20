<?php
class Controller
{
    public  static function redirect(string $location,$parameters=[])
    {
        $query=http_build_query($parameters);
        header("Location: $location?".$query, true,  301);
        exit();
    }

    public function accessCheck($userroles=[]){
        session_start();
        if (isset($_SESSION["user_type"]))
            foreach ($userroles as $userrole)
                if ($userrole == $_SESSION["user_type"])
                    return $userrole;
        Controller::redirect('/login/view');
    }
}


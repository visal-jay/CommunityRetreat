<?php
class Controller
{
    public  static function redirect(string $location,$parameters=[])
    {
        $query=http_build_query($parameters);
        header("Location: $location?".$query, true,  301);
        exit();
    }

    public static function accessCheck($userroles=[],$event_id=''){
        if(!isset($_SESSION))
            session_start();
        if (isset($_SESSION["user"]["user_type"])){
            $data=array();
            if (in_array($_SESSION["user"]["user_type"], $userroles))
                array_push($data,$_SESSION["user"]["user_type"]);
            $moderator_treasurer=(new RegisteredUser)->getUserRoles($_SESSION["user"]["uid"],$event_id);
            if (in_array("moderator", $moderator_treasurer) && in_array("moderator", $userroles))
                array_push($data,"moderator");
            if (in_array("treasurer", $moderator_treasurer) && in_array("treasurer", $userroles))
                array_push($data,"treasurer");
            return $data;
        }
        
        Controller::redirect('/login/view');
    }
}

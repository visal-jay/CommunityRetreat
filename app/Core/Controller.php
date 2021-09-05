<?php
class Controller
{
    public  static function redirect(string $location,$parameters=[])
    {
        $query=http_build_query($parameters);
        header("Location: $location?".$query, true,  301);
        exit();
    }

    public static function accessCheck($userroles=[],$event_id='-1'){
        if(!isset($_SESSION))
            session_start();
        if (isset($_SESSION["user"]["user_type"])){
            $data=array();
            if (in_array($_SESSION["user"]["user_type"], $userroles))
                array_push($data,[$_SESSION["user"]["user_type"]=>true]);

            if($moderator_treasurer=(new RegisteredUser)->getUserRoles($_SESSION["user"]["uid"],$event_id)){
                if (in_array("moderator", $moderator_treasurer) && in_array("moderator", $userroles))
                    array_push($data,["moderator"=>true]);
                if (in_array("treasurer", $moderator_treasurer) && in_array("treasurer", $userroles))
                    array_push($data,["treasurer"=>true]);
            }

            if($_SESSION["user"]["user_type"]=="organization" && in_array("organisation", $userroles) && $event_id!='-1'){
                $events = new Events;
                $data["events"] = array();
                if ($result = $events->query(["org_uid" => $_SESSION["user"]["uid"], "status" => "published"]))
                    foreach ($result as $event)
                        array_push($data["events"], $event["event_id"]);
                if ($result = $events->query(["org_uid" => $_SESSION["user"]["uid"], "status" => "added"]))
                    foreach ($result as $event)
                        array_push($data["events"], $event["event_id"]);
                if (!in_array($event_id,$data["events"]))
                    Controller::redirect("/organisation/events");
            }

            if(in_array("guest_user", $userroles))
                array_push($data,["guest_user"=>true]);
            return $data;
        }
        
        Controller::redirect('/login/view');
    }
}

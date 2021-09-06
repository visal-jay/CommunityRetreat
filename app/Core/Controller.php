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

        $data=["admin"=>false,"organization"=>false,"moderator"=>false,"treasurer"=>false,"registered_user"=>false,"guest_user"=>false];

        if(!isset($_SESSION))
            session_start();
        if (isset($_SESSION["user"]["user_type"])){
            if (in_array($_SESSION["user"]["user_type"], $userroles))
                $data[$_SESSION["user"]["user_type"]]=true;
            

            if($moderator_treasurer=(new RegisteredUser)->getUserRoles($_SESSION["user"]["uid"],$event_id)){
                if (in_array("moderator", $moderator_treasurer) && in_array("moderator", $userroles))
                    $data["moderator"]=true;
                if (in_array("treasurer", $moderator_treasurer) && in_array("treasurer", $userroles))
                    $data["treasurer"]=true;
            }

            if($_SESSION["user"]["user_type"]=="organization" && in_array("organisation", $userroles) && $event_id!='-1'){
                $events = new Events;
                $user_events = array();
                if ($result = $events->query(["org_uid" => $_SESSION["user"]["uid"], "status" => "published"]))
                    foreach ($result as $event)
                        array_push($user_events, $event["event_id"]);
                if ($result = $events->query(["org_uid" => $_SESSION["user"]["uid"], "status" => "added"]))
                    foreach ($result as $event)
                        array_push($user_events, $event["event_id"]);
                if (!in_array($event_id,$user_events))
                    Controller::redirect("/organisation/events");
            }
        }

        if(in_array("guest_user", $userroles))
            $data["guest_user"]=true;

        if(array_search(true,$data))
            return $data;

        Controller::redirect('/login/view');
    }
}

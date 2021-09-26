<?php
class Controller
{
    public  static function redirect(string $location, $parameters = [])
    {
        $query = http_build_query($parameters);
        header("Location: $location?" . $query, true,  302);
        exit();
    }

    public static function validateForm($post=[],$get=[]){
        if(!(array_intersect(array_keys($_POST),$post)==$post && array_intersect(array_keys($_GET),$get)==$get)){
            Controller::redirect(isset($_SERVER['http_referer']) ? $_SERVER['http_referer'] :"/");
        }
        else
            return true;
    }


    public static function accessCheck($userroles = [], $event_id = '-1')
    {

        $data = ["admin" => false, "organization" => false, "moderator" => false, "treasurer" => false, "registered_user" => false, "guest_user" => false];

        if (isset($_SESSION["user"]["user_type"])) {
            if (in_array($_SESSION["user"]["user_type"], $userroles))
                $data[$_SESSION["user"]["user_type"]] = true;

            if ($moderator_treasurer = (new RegisteredUser)->getUserRoles($_SESSION["user"]["uid"], $event_id)) {
                if (in_array("moderator", $moderator_treasurer) && in_array("moderator", $userroles))
                    $data["moderator"] = true;
                if (in_array("treasurer", $moderator_treasurer) && in_array("treasurer", $userroles))
                    $data["treasurer"] = true;
            }

            if ($_SESSION["user"]["user_type"] == "organization" && in_array("organization", $userroles) && $event_id != '-1') {
                $events = new Events;
                $user_events = array();
                if ($result = $events->query(["org_uid" => $_SESSION["user"]["uid"], "status" => "published"]))
                    foreach ($result as $event)
                        array_push($user_events, $event["event_id"]);
                if ($result = $events->query(["org_uid" => $_SESSION["user"]["uid"], "status" => "added"]))
                    foreach ($result as $event)
                        array_push($user_events, $event["event_id"]);
                if (!in_array($event_id, $user_events))
                    Controller::redirect("/Organisation/events");
            }
        } elseif (in_array("guest_user", $userroles))
            $data["guest_user"] = true;

        if (array_search(true, $data))
            return $data;

        else {
            ?>
        
        <a href="/Login/view" id="link">&nbsp;</a>
        <script>link.click()</script>

            <?php 
            die();
            //  $redirect= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            //Controller::redirect('/Login/view',["redirect"=>$redirect]);
        }
    }
}

<?php
class Controller
{
    function __construct()
    {
        Model::beginTransaction();
    }

    function __destruct()
    {
        Model::endTransaction();
    }

    public  static function redirect(string $location, $parameters = [])
    {
        if (count($parameters) == 0)
            header("Location: $location", true,  302);
        else {
            $query = http_build_query($parameters);
            header("Location: $location?" . $query, true,  302);
        }
        exit();
    }

    public static function validateForm($post = [], $get = [])
    {
        if (!(array_intersect($post, array_keys($_POST)) == $post && array_intersect($get, array_keys($_GET)) == $get)) {
            Controller::redirect(isset($_SERVER['http_referer']) ? $_SERVER['http_referer'] : "/");
        } else
            return true;
    }


    public static function accessCheck($userroles = [], $event_id = '-1')
    {
        $events = new Events;
        $data = ["admin" => false, "organization" => false, "moderator" => false, "treasurer" => false, "registered_user" => false, "guest_user" => false];

        if ($event_id != '-1'){
            $event_details = $events->getDetails($event_id);
            $event_status = $event_details["status"];
            $event_org = $event_details["org_uid"];
        }

        //logged in user
        if (isset($_SESSION["user"]["user_type"])) {
            if (in_array($_SESSION["user"]["user_type"], $userroles))
                $data[$_SESSION["user"]["user_type"]] = true;

            //treasurer moderetator access check
            $moderator_treasurer = (new RegisteredUser)->getUserRoles($_SESSION["user"]["uid"], $event_id);
            
            if ($moderator_treasurer && $event_status != "deleted") {
                $data["registered_user"] = true;
                if (in_array("moderator", $moderator_treasurer) && in_array("moderator", $userroles)) {
                    $data["moderator"] = true;
                    if (in_array("treasurer", $moderator_treasurer))
                        $data["treasurer"] = true;
                }
                if (in_array("treasurer", $moderator_treasurer) && in_array("treasurer", $userroles)) {
                    $data["treasurer"] = true;
                    if (in_array("moderator", $moderator_treasurer))
                        $data["moderator"] = true;
                }
            }

            //organization admin access check
            if ($_SESSION["user"]["user_type"] == "organization" && in_array("organization", $userroles) && $event_id != '-1' && $event_status!="deleted" && $event_org == $_SESSION["user"]["uid"])
                {}
            else if ($_SESSION["user"]["user_type"] == "organization" && in_array("organization", $userroles) && $event_id!='-1')
                Controller::redirect("/Organisation/events");
            /* if ($_SESSION["user"]["user_type"] == "organization" && in_array("organization", $userroles) && $event_id != '-1') {
                var_dump($event_org);
                var_dump($_SESSION["user"]["uid"]);
                exit;
                $user_events = array();
                if ($result = $events->query(["org_uid" => $_SESSION["user"]["uid"], "status" => "published"]))
                    foreach ($result as $event)
                        array_push($user_events, $event["event_id"]);
                if ($result = $events->query(["org_uid" => $_SESSION["user"]["uid"], "status" => "added"]))
                    foreach ($result as $event)
                        array_push($user_events, $event["event_id"]);
                if ($result = $events->query(["org_uid" => $_SESSION["user"]["uid"], "status" => "ended"]))
                    foreach ($result as $event)
                        array_push($user_events, $event["event_id"]);
                if (!in_array($event_id, $user_events))
                    Controller::redirect("/Organisation/events");
            } */
        } 
        //guest user

        elseif (in_array("guest_user", $userroles)) {
            $data["guest_user"] = true;
            
            if($event_id != '-1' && $event_status != "published")
                Controller::redirect("/");
        }

        if (array_search(true, $data))
            return $data;

        else {
?>

            <a href="/Login/view" id="link">&nbsp;</a>
            <script>
                link.click()
            </script>

<?php
            die();
            //  $redirect= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            //Controller::redirect('/Login/view',["redirect"=>$redirect]);
        }
    }

    //function to send POST request to the server
    public static function send_post_request($url, $data)
    {
        $ch = curl_init();
        $headers = array(
            "Cookie: " . getallheaders()["Cookie"],
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        session_write_close();
        $server_output = curl_exec($ch);
        curl_close($ch);
        return $server_output;
    }

    //function to send GET request to the server
    public static function send_get_request($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        return $server_output;
    }
}

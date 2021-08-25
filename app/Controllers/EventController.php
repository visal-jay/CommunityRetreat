<?php
class EventController
{

    public function view()
    {
        if (isset($_GET["event_id"])) {
            $register_user = new RegisteredUser;
            $event = new Events;
            $organisation = new Organisation;
            if (!isset($_SESSION))
                session_start();
            $uid = $_SESSION["user"]["uid"] = "REG0000016";
            if ($event_details = $event->getDetails($_GET["event_id"])) {
                $data = $event_details;
                $organisation_details = $organisation->getDetails($event_details['org_uid']);
                if ($user_roles = $register_user->getUserRoles($uid, $_GET["event_id"]))
                    $data = array_merge($data, $user_roles);
                $data["org_username"] = $organisation_details["username"];
                $data["volunteered"]= $data["volunteered"]==""? "0":  $data["volunteered"];
                $data["donations"]= $data["donations"]==""? "0":  $data["donations"];
                View::render("aboutEvent", $data);
            }
        } else
            View::render("home");
    }


    public function addEvent()
    {
        $validate = new Validation;

        var_dump($_POST);
        (new Events)->addEvent($_POST);
    }

    public function updateDetails()
    {
        Controller::accessCheck(["moderator", "organization"], $_GET["event_id"]);
        $validate = new Validation;
        if (!$validate->telephone($_POST["telephone"])) {
            $data["telephoneErr"] = "You ebeterd wrong number";
        }
        if (isset($data["emailErr"]))
            Controller::redirect("/event/view", $data);

        $events = new Events;
        $events->updateDetails($_POST);
        Controller::redirect("event/view");
    }
}

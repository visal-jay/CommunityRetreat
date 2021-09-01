<?php
class EventController
{

    public function view()
    {
        if (isset($_GET["event_id"]) && isset($_GET["page"])) {
            $page=$_GET["page"];
            (new EventController)->$page();
        } 
        else
            View::render("home");
    }

    public function about()
    {
        $register_user = new RegisteredUser;
        $event = new Events;
        $organisation = new Organisation;
        if (!isset($_SESSION))
            session_start();
        if ($event_details = $event->getDetails($_GET["event_id"])) {
            $data = $event_details;
            if ($user_roles =Controller::accessCheck(["moderator","organization"], $_GET["event_id"]))
                $data = array_merge($data, $user_roles);
            $data["volunteered"] = $data["volunteered"] == "" ? "0" :  $data["volunteered"];
            $data["donations"] = $data["donations"] == "" ? "0" :  $data["donations"];
            View::render("eventPage", $data);
        }
        else
            View::render("home");
    }

    public function userroles(){
        View::render('eventPage');
    }

    public function gallery(){
        
    }

    public function budget(){
        (new BudgetController)->view();
    }

    public function donations(){
        View::render('eventPage');
    }

    public function volunteers(){
        $ip = $_SERVER['REMOTE_ADDR'];
        View::render("eventPage",);
    }
    public function volunteerValidate(){
        View::render("volunteerThank");
    }

    public function addEvent()
    {
        $validate = new Validation;
        var_dump($_POST);
        (new Events)->addEvent($_POST);
        Controller::redirect("/organisation/events");
    }

    public function updateDetails()
    {
        Controller::accessCheck(["moderator", "organization"], $_GET["event_id"]);
        $validate = new Validation;
        if (!$validate->telephone($_POST["telephone"])) {
            $data["telephoneErr"] = "You eneterd wrong number";
        }
        if (isset($data["emailErr"]))
            Controller::redirect("/event/view", $data);

        $events = new Events;
        $events->updateDetails($_POST);
        Controller::redirect("event/view");
    }

    public function remove(){
        (new Events)->remove($_POST["event_id"]);
        Controller::redirect("/organisation/events");
    }
}

<?php

class VolunteerController
{
    //volunteer

    public function view($event_details)
    {
        $user_roles = Controller::accessCheck(["moderator", "organization"], $_GET["event_id"]);
        $data = array_intersect_key((new Events)->getDetails($_GET["event_id"]), ["volunteer_status" => '', "volunteer_capacity" => '', "status" => '']);
        $volunteer = new Volunteer();

        $data["volunteer_graph"] = json_encode($volunteer->getReport(["event_id" => $_GET["event_id"]]));
        $data['volunteer_capacities'] = $volunteer->getVolunteerCapacities($_GET["event_id"]);
        $data['volunteer_sum'] = $volunteer->getVolunteerSum($_GET["event_id"]);
        $data["volunteers"] =  $volunteer->getVolunteerDetails($_GET["event_id"]);
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://';
        $data["DOMAIN"] = $protocol . $_SERVER['HTTP_HOST'];
        $data = array_merge($data, $event_details);
        View::render('eventPage', $data, $user_roles);
    }
    public function disableVolunteer()
    { //disable donations for an event
        Controller::validateForm([], ["event_id"]);
        Controller::accessCheck(["moderator", "organization"], $_GET['event_id']);
        $volunteer = new Volunteer;
        $volunteer->disableVolunteer($_GET["event_id"]);
        $event_details = (new Events)->getDetails($_GET["event_id"]);
        (new UserController)->addActivity("Disable volunteer for {$event_details['event_name']}", $_GET['event_id']);
        Controller::redirect("/Event/view", ["event_id" => $_GET["event_id"], "page" => "volunteers"]);
    }

    public function enableVolunteer()
    { //enable volunteering for an event
        Controller::validateForm([], ["event_id"]);
        Controller::accessCheck(["moderator", "organization"], $_GET['event_id']);
        $volunteer = new Volunteer;
        $event_details = (new Events)->getDetails($_GET['event_id']);
        (new UserController)->addActivity("Enable volunteer for {$event_details['event_name']}", $_GET['event_id']);
        $volunteer->enableVolunteer($_GET["event_id"]);
        Controller::redirect("/Event/view", ["event_id" => $_GET["event_id"], "page" => "volunteers"]);
    }

    public function updateVolunteerCapacity()
    { //update volunteering capacity
        Controller::accessCheck(["moderator", "organization"], $_GET['event_id']);
        $volunteer = new Volunteer;
        $event_details = (new Events)->getDetails($_GET['event_id']);
        $volunteer->updateVolunteerCapacity($_GET["event_id"], $_POST);
        (new UserController)->addActivity("You update volunteer capacities of {$event_details['event_name']}", $_GET['event_id']);
        Controller::redirect("/Event/view", ["event_id" => $_GET["event_id"], "page" => "volunteers"]);
    }

    public function volunteerValidate()
    {
        //mark participation
        Controller::accessCheck(["registered_user"]);
        Controller::validateForm([], ["event_id"]);
        $event_details = (new Events)->getDetails($_GET['event_id']);
        $today = gmdate("Y-m-d", (int)shell_exec("date '+%s'"));
        // check if today is betwwen start and end date of event
        if ($today >= $event_details['start_date'] && $today <= $event_details['end_date']) {
            (new UserController)->addActivity("You marked your participation in {$event_details['event_name']}", $_GET['event_id']);
            (new Volunteer)->markParticipation($_GET["event_id"]);
            View::render("volunteerThank");
        } else {
            Controller::redirect("/Event/view", ["event_id" => $_GET["event_id"], "page" => "home","action" => "volunteer"]);
        }
    }


    public function volunteerEvent()
    {
        if (isset($_POST['volunteer_date'])) {
            Controller::validateForm(["volunteer_date"], ["event_id"]);
            $volunteer_dates = $_POST['volunteer_date'];
        } else {
            $volunteer_dates = [];
        }
        $volunteer = new Volunteer();
        $event_id = $_GET['event_id'];
        $description = $volunteer->addVolunteerDetails($_SESSION["user"]["uid"], $event_id, $volunteer_dates);
        (new UserController)->addActivity($description, $event_id);
        Controller::redirect("/Event/view", ["page" => "about", "event_id" => $event_id]);
    }


    public function volunteerReport()
    {
        Controller::validateForm([], ["url", "event_id"]);
        Controller::accessCheck(["organization", "moderator"], $_GET["event_id"]);/*check whether organization or treasurer accessed it.*/
        $volunteer = new Volunteer;
        if (isset($_POST["volunteer_date"]) && $_POST["volunteer_date"] != "") {
            $data["volunteers"] = $volunteer->getVolunteerDetails($_GET["event_id"], 0, 0, $_POST["volunteer_date"]);
            $data["volunteer_date_req"] = $_POST["volunteer_date"];
        } else {
            $data["volunteers"] = $volunteer->getVolunteerDetails($_GET["event_id"]);
            $data["volunteer_date_req"] = FALSE;
        }
        $data['volunteer_capacities'] = $volunteer->getVolunteerCapacities($_GET["event_id"]);
        $data["volunteer_graph"] = json_encode($volunteer->getReport(["event_id" => $_GET["event_id"]]));
        $data["event_name"]  = (new Events)->getDetails($_GET["event_id"])["event_name"];
        View::render('volunteerReport', $data);/*send all the data to volunteerReport page*/
    }

    public function sendNotificationstoVolunteers($notification, $path, $event_id, $body_file, $data, $subject)
    {
        $volunteer = new Volunteer();
        $volunteers = $volunteer->getVolunteeredUid($event_id);
        $path = "window.location.href='" . $path . "'";
        for ($i = 0; $i < count($volunteers); $i++) {
            foreach ($volunteers[$i] as $uid) {
                (new UserController)->sendNotifications($notification, $uid, "event", $path, $event_id, $body_file, $data, $subject);
            }
        }
    }

    public function notifyNearEvents()
    {
        $volunteer_controller = new VolunteerController();
        $events = new Events();
        $near_events = $events->getDetailsofNearEvents();
        foreach ($near_events as $event) {
            $event_details = $events->getDetails($event['event_id']);
            if ($event['volunteer_date'] == Date('Y-m-d', strtotime('+3 days')))
                $volunteer_controller->sendNotificationstoVolunteers("Only 3 days more for {$event_details['event_name']}", "/Event/view?page=about&event_id={$event["event_id"]}", $event["event_id"], "nearEventMail", ["event_name" => $event_details['event_name'], "remaining_days_count" => 3], "3 days more...!");
            if ($event['volunteer_date'] == Date('Y-m-d', strtotime('+7 days')))
                $volunteer_controller->sendNotificationstoVolunteers("Only 7 days more for {$event_details['event_name']}", "/Event/view?page=about&event_id={$event["event_id"]}", $event["event_id"], "nearEventMail", ["event_name" => $event_details['event_name'], "remaining_days_count" => 7], "7 days more...!");
        }
    }
}

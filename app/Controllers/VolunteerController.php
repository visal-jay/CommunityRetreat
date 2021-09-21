<?php 

class VolunteerController{
    //volunteer

    public function view($event_details){
        $user_roles = Controller::accessCheck(["moderator", "organization"]);
        $data = array_intersect_key((new Events)->getDetails($_GET["event_id"]), ["volunteer_status" => '', "volunteer_capacity" => '']);
        $volunteer = new Volunteer();
        $volunteer_details = $volunteer->getVolunteerDetails($_GET["event_id"]);
        $data["volunteers"] = $volunteer_details;
        $volunteer_sum = $volunteer->getVolunteerSum($_GET["event_id"]);
        $data["volunteer_sum"] = $volunteer_sum;
        $data["ip"] = exec('ifconfig | grep "inet " | grep -v 127.0.0.1 | cut -d\  -f2');
        $data = array_merge($data, $event_details);
        View::render('eventPage', $data, $user_roles);
    }
    public function disableVolunteer()
    { //disable donations for an event
        $volunteer = new Volunteer;
        $volunteer->disableVolunteer($_GET["event_id"]);
        Controller::redirect("/Event/view", ["event_id" => $_GET["event_id"], "page" => "volunteers"]);
    }

    public function enableVolunteer()
    { //enable volunteering for an event
        $volunteer = new Volunteer;
        $volunteer->enableVolunteer($_GET["event_id"]);
        Controller::redirect("/Event/view", ["event_id" => $_GET["event_id"], "page" => "volunteers"]);
    }

    public function updateVolunteerCapacity()
    { //update volunteering capacity
        $volunteer = new Volunteer;
        $volunteer->updateVolunteerCapacity($_GET["event_id"], $_POST["volunteer_capacity"]);
        Controller::redirect("/Event/view", ["event_id" => $_GET["event_id"], "page" => "volunteers"]);
    }

    public function volunteerValidate()
    {
        View::render("volunteerThank");
    }
}
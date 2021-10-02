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
        $data['volunteer_capacities'] = $volunteer->getVolunteerCapacities($_GET["event_id"]);
        $data['volunteer_sum'] = $volunteer->getVolunteerSum($_GET["event_id"]);
        View::render('eventPage', $data, $user_roles);
    }
    public function disableVolunteer()
    { //disable donations for an event
        Controller::validateForm([],["event_id"]);
        Controller::accessCheck(["moderator","organization"]);
        (new UserController)->addActivity("Disable volunteer",$_GET['event_id']);
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
        $volunteer->updateVolunteerCapacity($_GET["event_id"],$_POST);
        Controller::redirect("/Event/view", ["event_id" => $_GET["event_id"], "page" => "volunteers"]);
    }

    public function volunteerValidate()
    {
        //mark participation
        Controller::accessCheck(["registered_user"]);
        Controller::validateForm([],["event_id"]);
        (new Volunteer)->markParticipation();
        View::render("volunteerThank");
    }

    public function VolunteerEvent(){
        if(isset($_POST['volunteer_date'])){
            Controller::validateForm(["volunteer_date"],["event_id"]);
            $volunteer_dates = $_POST['volunteer_date'];  
        }
        else{
            $volunteer_dates =[];
        }
        $volunteer = new Volunteer();
        $event_id = $_GET['event_id'];
        $volunteer->addVolunteerDetails($event_id,$volunteer_dates);
        $description = $volunteer->addVolunteerDetails($event_id,$volunteer_dates);
        (new UserController)->addActivity($description,$event_id);
        Controller::redirect("/Event/view", ["page" => "about", "event_id" => $event_id ]);
    }


    public function volunteerReport()
    {
        Controller::validateForm([], ["url", "event_id"]);
        Controller::accessCheck(["organization"], $_GET["event_id"]);/*check whether organization or treasurer accessed it.*/
        
        $volunteer = new Volunteer;
        $data["volunteers"] = $volunteer->getVolunteerDetails($_GET["event_id"]);
        $data["volunteer_graph"] = json_encode($volunteer->getReport(["event_id" => $_GET["event_id"]]));
        $data["event_name"]  = (new Events)->getDetails($_GET["event_id"])["event_name"];
        View::render('volunteerReport', $data);/*send all the data to volunteerReport page*/
    }

}


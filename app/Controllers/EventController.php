<?php

use Stripe\Event;

class EventController
{

    public function view()
    {
        if ($event_details = array_intersect_key((new Events)->getDetails($_GET["event_id"]),["event_name" => '', "cover_photo" => '',"status" => '', "end_date"=>''])) {
            $page=isset($_GET["page"]) ? $_GET["page"] : "home" ;
            $this->$page($event_details);
        } else
            Controller::redirect("/User/home");
    }

    public function home ($event_details){
        $user_roles = Controller::accessCheck(["moderator","treasurer", "organization", "guest_user", "registered_user","admin"], $_GET["event_id"]);
        $event = new Events;
        if ($event_details = $event->getDetails($_GET["event_id"])) {
            $data = $event_details;
            View::render("eventPage", $data, $user_roles);
        } else
            Controller::redirect("/User/home");
    }

    public function about($event_details)
    {
        $user_roles = Controller::accessCheck(["moderator","treasurer", "organization", "guest_user", "registered_user","admin"], $_GET["event_id"]);
        $event = new Events;
        $volunteer = new Volunteer();
        $uid = isset($_SESSION['user']['uid']) ? $_SESSION['user']['uid'] : '';

        if ($event_details = $event->getDetails($_GET["event_id"])) {
            $data = $event_details;
            $data["volunteered"] = $data["volunteered"] == "" ? "0" :  $data["volunteered"];
            $data["donations"] = $data["donations"] == "" ? "0" :  $data["donations"];
            $data["volunteer_date"] = $volunteer->getVolunteeredDates($uid,$_GET["event_id"]);
            $data["volunteer_capacity_exceeded"]=$volunteer->checkVolunteerCount($_GET["event_id"],$data['start_date'],$data['end_date']);
            $data["volunteer_date"] = $volunteer->getVolunteeredDates($uid,$_GET["event_id"]);
            View::render("eventPage", $data, $user_roles);
           
        } 
        else
            Controller::redirect("/User/home");
    }

    public function addPhoto()
    {
        (new Gallery)->addPhoto(["event_id" => $_GET["event_id"]]);
        (new UserController)->addActivity("Added photo ", $_GET["event_id"]);
        echo "success";
    }

    public function userroles($event_details)
    {
        $user_roles = Controller::accessCheck(["organization"]);
        $data["users"] = (new Organisation)->getUserRoles($_GET["event_id"]);
        $data = array_merge($data, $event_details);
        View::render('eventPage', $data, $user_roles);
    }

    public function gallery($event_details)
    {
        $user_roles = Controller::accessCheck(["moderator", "organization", "guest_user", "registered_user", "treasurer"], $_GET["event_id"]);
        $pagination = Model::pagination("add_photo", 12, " WHERE event_id = :event_id", ["event_id" => $_GET["event_id"]]);
        if (!$data = (new Gallery)->getGallery(["event_id" => $_GET["event_id"], "offset" => $pagination["offset"], "no_of_records_per_page" => $pagination["no_of_records_per_page"]]))
            $data = array();
        else
            for ($i = 0; $i < count($data); $i++) {
                if (isset($_SESSION["user"]) && $data[$i]["uid"] == $_SESSION["user"]["uid"]) {
                    $temp = $data[$i];
                    array_splice($data, $i, 1);
                    array_unshift($data, $temp);
                }
            }
        View::render("eventPage", array_merge($event_details, ["photos" => $data], $pagination), $user_roles);
    }

    public function deletePhoto()
    {
        (new Gallery)->deletePhoto(["image" => $_POST["photo"]]);
        (new UserController)->addActivity("Deleted photo", $_GET["event_id"]);
        Controller::redirect("/Event/view", ["event_id" => $_GET["event_id"], "page" => "gallery"]);
    }


    public function budget($event_details)
    {
        (new BudgetController)->view($event_details);
    }

    public function donations($event_details)
    {
        (new DonationsController)->view($event_details);
    }


    public function volunteers($event_details)
    {
        (new VolunteerController)->view($event_details);
    }

    public function timeline($event_details)
    {
        (new WorkTimelineController)->view($event_details);
    }

    public function forum($event_details)
    {
        (new ForumController)->view($event_details);
    }

    public function addEvent()
    {
        Controller::accessCheck(["organization"]);
        (new Events)->addEvent($_POST);
        Controller::redirect("/Organisation/events");
    }

    public function updateDetails()
    {
        Controller::accessCheck(["moderator", "organization", "guest_user", "registered_user"], $_GET["event_id"]);
        $user = new UserController;
        $validate = new Validation;
        foreach ($_POST as $key => $value) {
            $_POST[$key] = trim($_POST[$key]);
            if ($_POST[$key] == "" || $_POST[$key] == "NULL")
                unset($_POST[$key]);
        }
        $volunteer = new Volunteer;
        $volunteered_uid = $volunteer->getvolunteereduidOutofRange( $_GET["event_id"], $_POST["start_date"], $_POST["end_date"]); //Get volunteers uids which are not belongs to of updated event date range
        for ($i = 0; $i < count($volunteered_uid); $i++) {
            foreach ($volunteered_uid[$i] as $uid) {
                $user->sendNotifications("{$_POST['event_name']} event informations has been changed.Please volunteer again..!",$uid,"event","window.location.href='/Event/view?page=about&&event_id={$_GET["event_id"]}'",$_GET["event_id"],"eventUpdateMail",["event_name"=>$_POST['event_name'] ,"volunteered_date_changed"=> true],"{$_POST['event_name']} event informations has been changed..!"); //Send notifications to volunteers who are kicked out because of the event date range update.
                $volunteer->removeVolunteersOutofRange( $_GET["event_id"],$uid,$_POST["start_date"],$_POST["end_date"]); //Remove volunteers who are kicked out because of the event date range update.
            }
        }
        (new VolunteerController)->sendNotificationstoVolunteers("{$_POST['event_name']} event informations has been changed!","/Event/view?page=about&event_id={$_GET["event_id"]}",$_GET["event_id"],"eventUpdateMail",["event_name"=>$_POST['event_name'] ,"volunteered_date_changed"=> false],"{$_POST['event_name']} event informations has been changed..!"); //Send notifications to volunteers who are not kicked out because of the event date range update.
        $events = new Events;
        $events->updateDetails(array_merge($_POST, $_GET)); //Update the event details
        Controller::redirect("/Event/view", ["page" => "about", "event_id" => $_GET["event_id"]]);
    }

    public function remove()
    {
        Controller::validateForm(["event_id"], []);
        Controller::accessCheck(["admin", "organization"]);
        
        $time = (int)shell_exec("date '+%s'");
        $event = new Events();
        $event_details = $event->getDetails($_POST["event_id"]);
        $end_date = $event_details["end_date"];
        $userroles = (new Organisation)->getUserRoles($_POST["event_id"]); //Get moderators and treasurers of the event
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://';
        $DOMAIN = $protocol . $_SERVER['HTTP_HOST'];
        foreach($userroles as $user)
        {
            if($user["moderator_flag"])  
                Controller::send_post_request($DOMAIN."/Organisation/deleteUserRole?event_id" . $_POST["event_id"],["role"=>"Moderator","uid"=>$user["uid"]]); //Send post request to  call deleteUserrole method to delete moderator of the removed event
            if($user["treasurer_flag"])
                Controller::send_post_request($DOMAIN."/Organisation/deleteUserRole?event_id" . $_POST["event_id"],["role"=>"Treasurer","uid"=>$user["uid"]]); //Send post request to  call deleteUserrole method to delete treasurer of the removed event
        }
        
        if (gmdate("Y-m-d", $time) < $end_date) {
            (new DonationsController)->donationRefund($_POST["event_id"]); //Refund the donation of the removed event
        }
        (new VolunteerController)->sendNotificationstoVolunteers("{$event_details['event_name']} event  has been removed.","/",$_POST["event_id"],"removeEventMail",["event_name"=>$event_details['event_name']],"{$event_details['event_name']} event  has been removed."); //Send notification to all the volunteers who are volunteered to the removed event
        (new Volunteer)->removeVolunteers($_POST["event_id"]); //Remove volunteers of the removed event
        $event->remove($_POST["event_id"]); //Remove event
        Controller::redirect("/Organisation/events");
    }

    public function feedback($event_details)
    {
        (new FeedbackController)->view($event_details);
    }

    public function chat($event_details)
    {
        $user_roles = Controller::accessCheck(["organization", "moderator"], $_GET["event_id"]);
        View::render("eventPage", $event_details, $user_roles);
    }

    public function endEvents(){
        $event = new Events();
        $donation = new DonationsController;
        $ended_events = $event->getEndedEvents();
        foreach($ended_events as $event_id){
            $event -> endEvents($event_id);
            $donation -> donationCredit($event_id);
        }
    }

}

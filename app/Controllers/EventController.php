<?php
class EventController
{

    public function view()
    {
        $event_details=array_intersect_key((new Events)->getDetails($_GET["event_id"]),["event_name"=>'',"cover_photo"=>'']);
        if (isset($_GET["event_id"]) && isset($_GET["page"])) {
            $page=$_GET["page"];
            (new EventController)->$page($event_details);
        } 
        else
            View::render("home");
    }

    public function about()
    {
        $user_roles =Controller::accessCheck(["moderator","organization","guest_user","registered_user"], $_GET["event_id"]);
        $register_user = new RegisteredUser;
        $event = new Events;
        $organisation = new Organisation;
        if (!isset($_SESSION))
            session_start();
        if ($event_details = $event->getDetails($_GET["event_id"])) {
            $data = $event_details;
            $data["volunteered"] = $data["volunteered"] == "" ? "0" :  $data["volunteered"];
            $data["donations"] = $data["donations"] == "" ? "0" :  $data["donations"];
            View::render("eventPage", $data,$user_roles);
        }
        else
            View::render("home");
    }

    public function addPhoto(){
        (new Gallery)->addPhoto(["event_id"=>$_GET["event_id"]]);
        Controller::redirect("/event/view",["event_id"=>$_GET["event_id"],"page"=>"gallery"]);
    }
    public function userroles($event_details){
        $user_roles=Controller::accessCheck(["organization"]);
        $data["users"]=(new Organisation)->getUserRoles($_GET["event_id"]);
        $data=array_merge($data,$event_details);
        View::render('eventPage',$data,$user_roles);
    }

    public function gallery($event_details){
        $user_roles =Controller::accessCheck(["moderator","organization","guest_user","registered_user"], $_GET["event_id"]);
        if (!$data=(new Gallery)->getGallery(["event_id"=>$_GET["event_id"]]))
            $data=array();
        else
            for ($i = 0; $i < count($data); $i++) {
                if(isset($_SESSION["user"]) && $data[$i]["uid"]==$_SESSION["user"]["uid"]){
                    $temp=$data[$i];
                    array_splice($data,$i,1);
                    array_unshift($data,$temp);
                }
            }
        View::render("eventPage",array_merge($event_details,["photos"=>$data]),$user_roles);
    }

    public function deletePhoto(){
        (new Gallery)->deletePhoto(["image"=>$_POST["photo"]]);
        Controller::redirect("/event/view",["event_id"=>$_GET["event_id"],"page"=>"gallery"]);

    }

   
    public function budget($event_details){
        (new BudgetController)->view($event_details);
    }

    public function donations($event_details){//view the donations in the UI by sending the data from backend
        $user_roles=Controller::accessCheck(["treasurer","organization"]);
        $data=array_intersect_key((new Events)->getDetails($_GET["event_id"]),["donation_status"=>'', "donation_capacity"=>'']);      
        $donation = new Donations();    
        $donate_details = $donation->getDonateDetails($_GET["event_id"]);
        $data["donations"]=$donate_details;
        $donate_sum = $donation->getDonationSum($_GET["event_id"]);
        $data["donation_sum"]=$donate_sum;
        $data = array_merge($data, $event_details);
        View::render('eventPage',$data,$user_roles); 
               
    }

    public function disableDonation(){//disable donations for an event
        $donation = new Donations;
        $donation->disableDonation($_GET["event_id"]);
        Controller::redirect("/event/view",["event_id"=> $_GET["event_id"], "page" => "donations"]);
    }

    public function enableDonation(){//enable donations for an event
        $donation = new Donations;
        $donation->enableDonation($_GET["event_id"]);
        Controller::redirect("/event/view",["event_id"=> $_GET["event_id"], "page" => "donations"]);
    }

    public function updateDonationCapacity(){//update donation capacity
        $donation = new Donations;
        $donation->updateDonationCapacity($_GET["event_id"], $_POST["donation_capacity"]);
        Controller::redirect("/event/view",["event_id"=> $_GET["event_id"], "page" => "donations"]);             
    }

    public function donationReport(){
        $donation = new Donations;
        $data["donations"]= $donation->donationReportGenerate($_GET["event_id"]);
        $data["donations_graph"]=json_encode($donation->getReport(["event_id"=>$_GET["event_id"]])) ;
        $data["event_name"]  = (new Events)->getDetails($_GET["event_id"])["event_name"];
        View::render('donationsReport',$data); 
    }

    

    public function BudgetReport(){
        $budget = new Budget();
        $income_report=$budget->IncomeReportGenerate($_GET["event_id"]);
        $expense_report=$budget->ExpenseReportGenerate($_GET["event_id"]);
        
        $data["report"]=$expense_report;
        array_push($data["report"], ...$income_report);
        usort($data["report"], function($a, $b) {
            return $a['date'] <=> $b['date'];
        });
        $data["income_report"]=$income_report;
        $data["expense_report"]=$expense_report;
        $current_report= array();
foreach($data["report"] as $report){
        if($report["status"]=='current'){
            array_push($current_report, $report);
        }}
        $data["report"]=$current_report;
        $data["income_sum"] = $budget->getIncomeSum($_GET["event_id"]);
        $data["expense_sum"]  = $budget->getExpenseSum($_GET["event_id"]);
        $data["event_name"]  = (new Events)->getDetails($_GET["event_id"])["event_name"];
        View::render('budgetReport',$data);
        
    }

    //volunteer

    public function disableVolunteer(){//disable donations for an event
        $volunteer = new Volunteer;
        $volunteer->disableVolunteer($_GET["event_id"]);
        Controller::redirect("/event/view",["event_id"=> $_GET["event_id"], "page" => "volunteers"]);
    }

    public function enableVolunteer(){//enable volunteering for an event
        $volunteer = new Volunteer;
        $volunteer->enableVolunteer($_GET["event_id"]);
        Controller::redirect("/event/view",["event_id"=> $_GET["event_id"], "page" => "volunteers"]);
    }

    public function updateVolunteerCapacity(){//update volunteering capacity
        $volunteer = new Volunteer;
        $volunteer->updateVolunteerCapacity($_GET["event_id"], $_POST["volunteer_capacity"]);
        Controller::redirect("/event/view",["event_id"=> $_GET["event_id"], "page" => "volunteers"]);             
    }

    public function volunteers($event_details){
        $user_roles=Controller::accessCheck(["moderator","organization"]);
        $data=array_intersect_key((new Events)->getDetails($_GET["event_id"]),["volunteer_status"=>'', "volunteer_capacity"=>'']);      
        $volunteer = new Volunteer();    
        $volunteer_details = $volunteer->getVolunteerDetails($_GET["event_id"]);
        $data["volunteers"]=$volunteer_details;
        $volunteer_sum = $volunteer->getVolunteerSum($_GET["event_id"]);
        $data["volunteer_sum"]=$volunteer_sum;
        $data["ip"] = exec('ifconfig | grep "inet " | grep -v 127.0.0.1 | cut -d\  -f2');
        $data = array_merge($data, $event_details);
        View::render('eventPage',$data,$user_roles); 
    }

    public function volunteerValidate(){
        View::render("volunteerThank");
    }

    public function timeline($event_details){
        $user_roles=Controller::accessCheck(["moderator","organization"]);
        View::render("eventPage",$event_details,$user_roles);
    }

    public function forum($event_details){
        $user_roles= Controller::accessCheck(["organization", "registered_user", "moderator", "guest_user"], $_GET["event_id"]);
        $data["announcements"] = (new Announcement)->getAnnouncement($_GET["event_id"]);
        $data = array_merge($data, $event_details);
        View::render("eventPage",$data, $user_roles);
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
        $_POST["event_id"] = $_GET["event_id"];
        Controller::accessCheck(["moderator", "organization","guest_user"], $_POST["event_id"]);
        var_dump($_POST);
        
        $validate = new Validation;
        foreach ($_POST as $key => $value){
            $_POST[$key]=trim($_POST[$key]);
            if($_POST[$key]=="" || $_POST[$key]=="NULL")
                unset ($_POST[$key]);
        }

        $events = new Events;
        $events->updateDetails($_POST);
        Controller::redirect("/event/view",["page"=>"about","event_id"=> $_POST["event_id"]]);
    }

    public function remove(){
        (new Events)->remove($_POST["event_id"]);
        Controller::redirect("/organisation/events");
    }

    public function addAnnouncement(){
        $_POST["event_id"] = $_GET["event_id"];
        (new Announcement)->addAnnouncement($_POST);
        Controller::redirect("/event/view",["page"=>"forum","event_id"=> $_POST["event_id"]]);
    }

    public function editAnnouncement(){
        $_POST["event_id"] = $_GET["event_id"];
        $announcement = new Announcement;
        $announcement->editAnnouncement($_POST);
        Controller::redirect("/event/view",["page"=>"forum","event_id"=> $_POST["event_id"]]);
    }

    public function deleteAnnouncement(){
        (new Announcement)->deleteAnnouncement($_POST["announcement_id"]);
        Controller::redirect("/event/view",["page"=>"forum","event_id"=> $_GET["event_id"]]);
    }

    public function feedback($event_details){  
        $feedback = new Feedback;
        $user_roles=Controller::accessCheck(["registered_user","organization","moderator"]);   
        $data = array();
        $data["feedbacks"] = $feedback->getFeedback($_GET["event_id"]);
        $data = array_merge($data, $event_details);
        $data = array_merge($data, $feedback->totalFeedback($_GET["event_id"]));
        View::render('eventPage',$data,$user_roles); 
    }

    public function addFeedback(){
        $_POST["event_id"] = $_GET["event_id"];
        $_POST["uid"] = $_SESSION["user"]["uid"];
        (new Feedback)->addFeedback($_POST);
        Controller::redirect("/event/view",["page"=>"feedback","event_id"=> $_POST["event_id"]]);
    }

}
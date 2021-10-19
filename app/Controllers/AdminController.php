<?php
class AdminController{

    // View admin homepage
    public function dashboard(){
        $user_roles = Controller::accessCheck(["admin"]);

        $admin=new Admin();

        $reg_user_count = $admin->regUserCount();
        $org_count = $admin->orgCount();
        $event_count = $admin->eventCount();
        //$event_count = $admin->eventCount();

        $data["reg_user_count"]=$reg_user_count;
        $data["org_count"]=$org_count;
        $data["event_count"]=$event_count;
        //$data["event_count"]=$event_count;
        View::render("adminPage",$data,$user_roles);
    }

    //View admin profile
    public function profile(){
        $user_roles = Controller::accessCheck(["admin"]);
        $admin=new Admin();
        $uid=$_SESSION["user"]["uid"];
        $admin_details=$admin->getDetails($uid); 
        View::render('adminProfile',$admin_details,$user_roles);
    }

    //View admin activity log
    public function activityLog(){
        $user_roles=Controller::accessCheck(["admin"]);
        View::render('history',$user_roles);
    }

    //View complaints
    public function complaint(){
        $user_roles=Controller::accessCheck(["admin"]);
        $data['complaints'] = (new Complaint)->getComplaints();
        View::render("admin",$data,$user_roles);
    }

    //View system feedbacks UI
    public function systemFeedbacks(){
        $user_roles=Controller::accessCheck(["admin"]);
        View::render("systemFeedback",[],$user_roles);
    }

    //Post system feedbacks to view
    public function viewFeedbacks(){
      
        $systemFeedback=new Systemfeedback();
        $systemFeedbacks= $systemFeedback->renderSystemFeedbacks();
        echo json_encode($systemFeedbacks);
        
    }

    //Mark system feedbacks as viewed
    public function feedbackViewed(){

        $systemFeedback=new Systemfeedback();
        $data=["feedback_id"=>$_POST['feedback_id']];
        $systemFeedback->changeFeedbackState($data);
        Controller::redirect("systemFeedbacks");
    }

    public function donationReport()/*Generate the report of all the donations*/
    {
        Controller::accessCheck(["admin"]);/*check whether admij accessed it.*/
        
        $donation = new Donations;
        $data["donations_graph"] = json_encode($donation->getReport(["event_id" => $_GET["event_id"]]));
        View::render('adminPage', $data);/*send all the data to admin page*/
    }

}

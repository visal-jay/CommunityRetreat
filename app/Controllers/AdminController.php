<?php
class AdminController{

    // View admin homepage
    public function dashboard(){
        $user_roles = Controller::accessCheck(["admin"]);

        $admin=new Admin();

        $reg_user_count = $admin->regUserCount();
        $org_count = $admin->orgCount();
        $event_count = $admin->eventCount();
        $data["donations_graph"] = json_encode($admin->getDonationReport());
        $data["volunteers_graph"] = json_encode($admin->getVolunteerReport());

        $data["reg_user_count"]=$reg_user_count;
        $data["org_count"]=$org_count;
        $data["event_count"]=$event_count;
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
        $pagination = Model::pagination("complaint", 10, "", []);
        $data['complaints'] = (new ComplaintController)->getComplaints(["offset" => $pagination["offset"], "no_of_records_per_page" => $pagination["no_of_records_per_page"]]);
        View::render("admin",array_merge($data,$pagination),$user_roles);
    }


    //Post system feedbacks to view
    public function systemFeedbacks(){
        $user_roles=Controller::accessCheck(["admin"]);
        $pagination = Model::pagination("system_feedback", 10, "", []);
        $systemFeedback=new SystemfeedbackController();
        $systemFeedbacks= $systemFeedback->getSystemFeedbacks(["offset" => $pagination["offset"], "no_of_records_per_page" => $pagination["no_of_records_per_page"]]);
        $data['system_feedbacks'] = $systemFeedbacks;
        View::render("systemFeedback",array_merge($data,$pagination),$user_roles); 
    }

    //Mark system feedbacks as viewed
    public function feedbackViewed(){
        Controller::validateForm(['feedback_id'],[]);
        $systemFeedback=new SystemfeedbackController();
        $data=["feedback_id"=>$_POST['feedback_id']];
        $systemFeedback->setFeedbackViewed($data);
        Controller::redirect("systemFeedbacks");
    }

    function removeUser(){
        Controller::validateForm(['uid','status'],[]);
        $user = new UserController();
        $complaint = new ComplaintController;
        $data= ["uid" =>$_POST['uid'], "status" => $_POST['status']];
        $user->sendNotifications("Your account has been removed...!",$data['uid'],"system","",-1,"removeUserMail",[],"Sorry, Your account has been removed..!");
        $user->removeUser($data['uid']);
        $complaint->removeComplaint($data);
        Controller::redirect("complaint");
    }

    function removeEvent(){
        Controller::validateForm(['event_id','status'],[]);
        $complaint = new ComplaintController;
        $user = new UserController();    
        $post_data= ["event_id" => $_POST['event_id']];
        $event_details = (new Events)->getDetails($_POST['event_id']);

        if($event_details['org_uid'] != NULL){
            $user->sendNotifications($event_details['event_name']." event has been removed...!",$event_details['org_uid'],"system","",-1,"removeEventMail",["event_name" => $event_details['event_name']],$event_details['event_name']." event has been removed...!");
        }
       
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://';
        $DOMAIN = $protocol . $_SERVER['HTTP_HOST'];
        Controller::send_post_request($DOMAIN."/Event/remove",$post_data);
        $data= ["event_id" =>$_POST['event_id'], "status" => $_POST['status']];
        $complaint->removeComplaint($data);
        Controller::redirect("complaint");    
    }

}

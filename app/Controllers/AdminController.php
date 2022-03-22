<?php
class AdminController
{

    // View admin homepage
    public function dashboard()
    {
        $user_roles = Controller::accessCheck(["admin"]);

        $admin = new Admin();
        $reg_user_count = $admin->regUserCount();   //get current registered users count
        $org_count = $admin->orgCount();    //get current organizarion users count
        $event_count = $admin->eventCount();    //get current event count
        $data["donations_graph"] = json_encode($admin->getDonationReport());    //get donation report for the graph
        $data["volunteers_graph"] = json_encode($admin->getVolunteerReport());  //get volunteer report for the graph

        $data["reg_user_count"] = $reg_user_count;
        $data["org_count"] = $org_count;
        $data["event_count"] = $event_count;
        View::render("adminPage", $data, $user_roles);
    }

    //View admin profile
    public function profile()
    {
        $user_roles = Controller::accessCheck(["admin"]);
        $admin = new Admin();
        $uid = $_SESSION["user"]["uid"];
        $admin_details = $admin->getDetails($uid);    //get admin profile details
        View::render('adminProfile', $admin_details, $user_roles);
    }

    //View admin activity log
    public function activityLog()
    {
        $user_roles = Controller::accessCheck(["admin"]);
        View::render('history', $user_roles);
    }

    //View complaints
    public function complaint()
    {
        $user_roles = Controller::accessCheck(["admin"]);
        $pagination = Model::pagination("complaint", 10, "", []);
        //get complaints 10 per page
        $data['complaints'] = (new ComplaintController)->getComplaints(["offset" => $pagination["offset"], "no_of_records_per_page" => $pagination["no_of_records_per_page"]]);
        View::render("admin", array_merge($data, $pagination), $user_roles);
    }


    //Post system feedbacks to view
    public function systemFeedbacks()
    {
        $user_roles = Controller::accessCheck(["admin"]);
        $pagination = Model::pagination("system_feedback", 10, "", []);
        $systemFeedback = new SystemfeedbackController();
        //get system feedbacks 10 per page
        $systemFeedbacks = $systemFeedback->getSystemFeedbacks(["offset" => $pagination["offset"], "no_of_records_per_page" => $pagination["no_of_records_per_page"]]);
        $data['system_feedbacks'] = $systemFeedbacks;
        View::render("systemFeedback", array_merge($data, $pagination), $user_roles);
    }

    //Mark system feedbacks as viewed
    public function feedbackViewed()
    {
        Controller::validateForm(['feedback_id'], []);
        $systemFeedback = new SystemfeedbackController();
        $data = ["feedback_id" => $_POST['feedback_id']];
        $systemFeedback->setFeedbackViewed($data);
        Controller::redirect("systemFeedbacks");
    }

    //remove unethical user
    function removeUser()
    {
        Controller::validateForm(['uid', 'status'], []);
        $user = new UserController();
        $complaint = new ComplaintController;
        $data = ["uid" => $_POST['uid'], "status" => $_POST['status']];
        //send notificitaion to the account holder that the account has been removed
        $user->sendNotifications("Your account has been removed...!", $data['uid'], "system", "", -1, "removeUserMail", [], "Sorry, Your account has been removed..!");
        $complaint->removeComplaint($data); //remove other complaints by the user
        $user->removeUser($data['uid']);    //remove user
        Controller::redirect("complaint");
    }

    function removeEvent()
    {
        Controller::validateForm(['event_id', 'status'], []);
        $complaint = new ComplaintController;
        $user = new UserController();
        $event_details = (new Events)->getDetails($_POST['event_id']);

        //remove other complaints of the to be deleted event
        $data = ["event_id" => $_POST['event_id'], "status" => $_POST['status']];
        $complaint->removeComplaint($data);
        
        //send event orgnaizers that the event has been removed
        if ($event_details['org_uid'] != NULL) {
            $user->sendNotifications($event_details['event_name'] . " event has been removed...!", $event_details['org_uid'], "system", "", -1, "removeEventMail", ["event_name" => $event_details['event_name']], $event_details['event_name'] . " event has been removed...!");
        }

        //current protocol and domain 
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://';
        $DOMAIN = $protocol . $_SERVER['HTTP_HOST'];
        //sending a post requset to EvnetController to remove the event
        $post_data = ["event_id" => $_POST['event_id']];
        Controller::send_post_request($DOMAIN . "/Event/remove", $post_data);

        Controller::redirect("complaint");
    }
}

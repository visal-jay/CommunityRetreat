<?php 

class FeedbackController {

    //retrieving data for feedback.php from backend
    public function view($event_details)
    {
        Controller::validateForm([], ["event_id"]); //checking all the required data are delivered from VIEW to function the MODEL  
        $user_roles = Controller::accessCheck(["registered_user", "organization", "moderator","guest_user", "admin"],$_GET["event_id"]); //feedback page can be accessed by every user role except treasurer.
        $feedback = new Feedback; //creating a new object of class Feedback called 'feedback'
        $data["feedbacks"] = array(); //creating an empty array 
        if(isset($_GET["complaint_feedback_id"]) && $user_roles["admin"]){ //view for admin(only if there is a complaint)
            $data["feedbacks"] = $feedback->getFeedback(-1,$_GET["complaint_feedback_id"]);
        }
        else if ($user_roles["moderator"] || $user_roles["organization"] || $user_roles["admin"]){ //view for moderator, organization and admin
            $pagination= Model::pagination("event_feedback", 8, "WHERE event_id= :event_id", ["event_id"=> $_GET["event_id"]]);
            $data["feedbacks"] = $feedback->getFeedback($_GET["event_id"], -1, $pagination["offset"], $pagination["no_of_records_per_page"]); //
        }
        else if ($user_roles["registered_user"] || $user_roles["guest_user"]){ //general view 
            $pagination= Model::pagination("event_feedback", 8, "WHERE event_id= :event_id AND status= :status", ["event_id"=> $_GET["event_id"],"status"=>'show']);
            $data["feedbacks"] = $feedback->getFeedback($_GET["event_id"], -1, $pagination["offset"], $pagination["no_of_records_per_page"], 'show');
        }
        $data = array_merge($data, $event_details, $feedback->totalFeedback($_GET["event_id"]), $pagination); //totalFeedback:average rating
        View::render('eventPage', $data, $user_roles);
    }

    public function addFeedback()
    {
        Controller::validateForm(["feedback", "rate"], ["event_id"]); //checking all the required data for method POST & GET respectively
        Controller::accessCheck(["registered_user"],$_GET["event_id"]); //a feedback can be added only by a registered user
        (new UserController)->addActivity("Add a feedback",$_GET["event_id"]); //inserting the feeback adding activity
        $_POST["event_id"] = $_GET["event_id"]; 
        $_POST["uid"] = $_SESSION["user"]["uid"];
        (new Feedback)->addFeedback($_POST); //calling the function from the MODEL
        Controller::redirect("/Event/view", ["page" => "feedback", "event_id" => $_GET["event_id"]]);
    }

    public function statusToggle()
    {
        Controller::validateForm([], ["event_id","feedback_id"]); //checking all the required data for method POST & GET respectively
        Controller::accessCheck(["organization","moderator","admin"],$_GET["event_id"]); //access available only for organization,moderator and admin
        (new UserController)->addActivity("Hide a feedback",$_GET["event_id"]); //inserting the h9iding feedback activity
        (new Feedback)->statusToggle($_GET["feedback_id"]); //request to hide/show feedback
        Controller::redirect("/Event/view", ["page" => "feedback", "event_id" => $_GET["event_id"]]);
    }
}
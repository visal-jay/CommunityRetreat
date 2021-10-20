<?php 

class FeedbackController {
    public function view($event_details)
    {
        Controller::validateForm([], ["event_id"]);   
        $user_roles = Controller::accessCheck(["registered_user", "organization", "moderator","guest_user", "admin"],$_GET["event_id"]);
        $pagination= Model::pagination("event_feedback", 5, "WHERE event_id= :event_id", ["event_id"=> $_GET["event_id"]]);
        $feedback = new Feedback;
        $data["feedbacks"] = array();
        if(isset($_GET["complaint_feedback_id"]) && $user_roles["admin"]){
            $data["feedbacks"] = $feedback->getFeedback(-1,$_GET["complaint_feedback_id"]);
        }
        else if ($user_roles["moderator"] || $user_roles["organization"] || $user_roles["admin"]){
            $data["feedbacks"] = $feedback->getFeedback($_GET["event_id"]);
        }
        else if ($user_roles["registered_user"] || $user_roles["guest_user"]){
            $data["feedbacks"] = $feedback->getFeedback($_GET["event_id"], -1, 'show');
        }
        $data = array_merge($data, $event_details);
        $data = array_merge($data, $feedback->totalFeedback($_GET["event_id"]));
        View::render('eventPage', $data, $user_roles);
    }

    public function addFeedback()
    {
        //feedback rate : Visal
        Controller::validateForm(["feedback", "rate"], ["event_id"]);
        Controller::accessCheck(["registered_user"],$_GET["event_id"]);
        (new UserController)->addActivity("Add a feedback",$_GET["event_id"]);
        $_POST["event_id"] = $_GET["event_id"];
        $_POST["uid"] = $_SESSION["user"]["uid"];
        (new Feedback)->addFeedback($_POST);
        Controller::redirect("/Event/view", ["page" => "feedback", "event_id" => $_GET["event_id"]]);
    }

    public function statusToggle()
    {
        Controller::validateForm([], ["event_id","feedback_id"]);
        Controller::accessCheck(["organization","moderator"],$_GET["event_id"]);
        (new UserController)->addActivity("Hide a feedback",$_GET["event_id"]);
        (new Feedback)->statusToggle($_GET["feedback_id"]);
        Controller::redirect("/Event/view", ["page" => "feedback", "event_id" => $_GET["event_id"]]);
    }
}
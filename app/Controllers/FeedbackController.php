<?php 

class FeedbackController {
    public function view($event_details)
    {
        $feedback = new Feedback;
        $user_roles = Controller::accessCheck(["registered_user", "organization", "moderator","guest_user"]);
        $data = array();
        if ($user_roles["moderator"] || $user_roles["organization"]){
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
        Controller::validateForm(["feedback", "rate"], ["event_id"]);
        Controller::accessCheck(["registered_user"]);
        (new UserController)->addActivity("Add a feedback",$_GET["event_id"]);
        $_POST["event_id"] = $_GET["event_id"];
        $_POST["uid"] = $_SESSION["user"]["uid"];
        (new Feedback)->addFeedback($_POST);
        Controller::redirect("/Event/view", ["page" => "feedback", "event_id" => $_POST["event_id"]]);
    }

    public function statusToggle()
    {
        Controller::validateForm([], ["event_id","feedback_id"]);
        Controller::accessCheck(["organization","moderator"]);
        (new UserController)->addActivity("Hide a feedback",$_GET["event_id"]);
        (new Feedback)->statusToggle($_GET["feedback_id"]);
        Controller::redirect("/Event/view", ["page" => "feedback", "event_id" => $_GET["event_id"]]);
    }
}
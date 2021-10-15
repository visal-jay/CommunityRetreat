<?php

class WorkTimelineController
{
    public function view($event_details)
    {
        $user_roles = Controller::accessCheck(["organization", "treasurer", "moderator",], $_GET["event_id"]);
        $data["tasks"] = (new Task)->getTask($_GET["event_id"]);
        $data = array_merge($data, $event_details);
        View::render("eventPage", $data, $user_roles);
    }

    public function addTask()
    {
        Controller::validateForm(["start_date", "end_date", "task"], ["event_id"]);
        Controller::accessCheck(["organization", "moderator"], $_GET["event_id"]);
        $event = (new Events)->getDetails($_GET["event_id"]);
        (new UserController)->addActivity("Add a task to the timeline", $_GET["event_id"]);
        $id = (new Organisation)->getUserRoles($_GET["event_id"]);
        for ($i = 0; $i < count($id); $i++) {
            if ($id[$i]["moderator_flag"] == 1) {
                (new UserController)->sendNotifications("New task has been added to {$event['event_name']}!", $id[$i]["uid"], "event", "window.location.href='/event/view?page=about&&event_id={$_GET["event_id"]}'", $_GET["event_id"]);
            }
        }
        $_POST["event_id"] = $_GET["event_id"];
        (new Task)->addTask($_POST);
        Controller::redirect("/Event/view", ["page" => "timeline", "event_id" => $_POST["event_id"]]);
    }

    public function editTask()
    {
        Controller::validateForm(["start_date", "end_date", "task", "task_id"], $_GET["event_id"]);
        Controller::accessCheck(["organization", "moderator"], $_GET["event_id"]);
        (new UserController)->addActivity("Edit an existing task", $_GET["event_id"]);
        $_POST["event_id"] = $_GET["event_id"];
        $task = new Task;
        $task->editTask($_POST);
        Controller::redirect("/Event/view", ["page" => "timeline", "event_id" => $_POST["event_id"]]);
    }

    public function deleteTask()
    {
        Controller::validateForm(["task_id"], ["event_id"]);
        Controller::accessCheck(["organization", "moderator"], $_GET["event_id"]);
        (new UserController)->addActivity("Delete an existing task", $_GET["event_id"]);
        (new Task)->deleteTask($_POST["task_id"]);
        Controller::redirect("/Event/view", ["page" => "timeline", "event_id" => $_GET["event_id"]]);
    }

    public function completed()
    {
        Controller::validateForm([], ["event_id", "task_id"]);
        Controller::accessCheck(["organization", "moderator"], $_GET["event_id"]);
        (new UserController)->addActivity("Hide a feedback", $_GET["event_id"]);
        (new Task)->completed($_GET["task_id"]);
        (new UserController)->addActivity("Hide a feedback", $_GET["event_id"]);
        Controller::redirect("/Event/view", ["page" => "timeline", "event_id" => $_GET["event_id"]]);
    }
}

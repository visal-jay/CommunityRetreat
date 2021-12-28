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
        (new UserController)->addActivity("You added a task to the timeline of {$event['event_name']}", $_GET["event_id"]);
        $id = (new Organisation)->getUserRoles($_GET["event_id"]);
        for ($i = 0; $i < count($id); $i++) {
            if ($id[$i]["moderator_flag"] == 1) {
                (new UserController)->sendNotifications("New task has been added to {$event['event_name']}...!", $id[$i]["uid"], "event", "window.location.href='/event/view?page=timeline&&event_id={$_GET["event_id"]}'", $_GET["event_id"],"addNewTaskMail",["event_name" => $event['event_name']],"New task from{$event['event_name']}...!");
            }
        }
        $_POST["event_id"] = $_GET["event_id"];
        (new Task)->addTask($_POST);
        Controller::redirect("/Event/view", ["page" => "timeline", "event_id" => $_POST["event_id"]]);
    }

    public function editTask()
    {
        Controller::validateForm(["start_date", "end_date", "task", "task_id"],["event_id"]);
        Controller::accessCheck(["organization", "moderator"], $_GET["event_id"]);
        $event = (new Events)->getDetails($_GET["event_id"]);
        (new UserController)->addActivity("You edited an existing task of {$event['event_name']}", $_GET["event_id"]);
        $id = (new Organisation)->getUserRoles($_GET["event_id"]);
        for ($i = 0; $i < count($id); $i++){
            if ($id[$i]["moderator_flag"] == 1) {
                (new UserController)->sendNotifications("Some task details of {$event['event_name']} has been edited!", $id[$i]["uid"], "event", "window.location.href='/event/view?page=about&&event_id={$_GET["event_id"]}'", $_GET["event_id"],"editNewTaskMail",["event_name" => $event['event_name']],"Some task of {$event['event_name']} has been edited...!");
            }
        }
        $_POST["event_id"] = $_GET["event_id"];
        $task = new Task;
        $task->editTask($_POST);
        Controller::redirect("/Event/view", ["page" => "timeline", "event_id" => $_POST["event_id"]]);
    }

    public function deleteTask()
    {
        Controller::validateForm(["task_id"], ["event_id"]);
        Controller::accessCheck(["organization", "moderator"], $_GET["event_id"]);
        $event = (new Events)->getDetails($_GET["event_id"]);
        (new UserController)->addActivity("You deleted an existing task of {$event['event_name']}", $_GET["event_id"]);
        $id = (new Organisation)->getUserRoles($_GET["event_id"]);
        for ($i = 0; $i < count($id); $i++){
            if ($id[$i]["moderator_flag"] == 1) {
                (new UserController)->sendNotifications("Some task of {$event['event_name']} has been deleted!", $id[$i]["uid"], "event", "window.location.href='/event/view?page=about&&event_id={$_GET["event_id"]}'", $_GET["event_id"],"deleteNewTaskMail",["event_name" => $event['event_name']],"Some task of {$event['event_name']} has been deleted!");
            }
        }
        (new Task)->deleteTask($_POST["task_id"]);
        Controller::redirect("/Event/view", ["page" => "timeline", "event_id" => $_GET["event_id"]]);
    }

    public function completed()
    {
        Controller::validateForm([], ["event_id", "task_id"]);
        Controller::accessCheck(["organization", "moderator"], $_GET["event_id"]);
        $event = (new Events)->getDetails($_GET["event_id"]);
        (new UserController)->addActivity("You completed a task of {$event['event_name']}", $_GET["event_id"]);
        $id = (new Organisation)->getUserRoles($_GET["event_id"]);
        for ($i = 0; $i < count($id); $i++){
            if ($id[$i]["moderator_flag"] == 1) {
                (new UserController)->sendNotifications("Some task of {$event['event_name']} has been completed!", $id[$i]["uid"], "event", "window.location.href='/event/view?page=about&&event_id={$_GET["event_id"]}'", $_GET["event_id"],"completeTaskMail",["event_name" => $event['event_name']],"Some task of {$event['event_name']} has been completed!");
            }
        }
        (new Task)->completed($_GET["task_id"]);
        Controller::redirect("/Event/view", ["page" => "timeline", "event_id" => $_GET["event_id"]]);
    }
}

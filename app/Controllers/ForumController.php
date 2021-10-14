<?php

class ForumController
{
    public function view($event_details)
    {
        $user_roles = Controller::accessCheck(["organization", "registered_user", "moderator", "guest_user"], $_GET["event_id"]);

        if (isset($_GET["update_announcement_id"]) && $user_roles["registered_user"]) {
            $data["announcements"] = (new Announcement)->getAnnouncement($_GET["event_id"], $_GET["update_announcement_id"]);
        } else {
            $data["announcements"] = (new Announcement)->getAnnouncement($_GET["event_id"]);
            $pagination = Model::pagination("work_timeline", 5, "WHERE event_id= :event_id", ["event_id" => $_GET["event_id"]]);
        }
        $data = array_merge($data, $event_details);
        View::render("eventPage", $data, $user_roles);
    }

    public function addAnnouncement()
    {
        Controller::validateForm(["title", "announcement"], ["event_id"]);
        Controller::accessCheck(["organization", "moderator"], $_GET["event_id"]);
        (new UserController)->addActivity("Add an announcement", $_GET["event_id"]);
        $_POST["event_id"] = $_GET["event_id"];
        (new Announcement)->addAnnouncement($_POST);
        Controller::redirect("/Event/view", ["page" => "forum", "event_id" => $_POST["event_id"]]);
    }

    public function editAnnouncement()
    {
        Controller::validateForm(["title", "announcement", "announcement_id"], ["event_id"]);
        Controller::accessCheck(["organization", "moderator"], $_GET["event_id"]);
        (new UserController)->addActivity("Edit an announcement", $_GET["event_id"]);
        $_POST["event_id"] = $_GET["event_id"];
        $announcement = new Announcement;
        $announcement->editAnnouncement($_POST);
        Controller::redirect("/Event/view", ["page" => "forum", "event_id" => $_POST["event_id"]]);
    }

    public function deleteAnnouncement()
    {
        Controller::validateForm(["announcement_id"], ["event_id"]);
        Controller::accessCheck(["organization", "moderator"], $_GET["event_id"]);
        (new UserController)->addActivity("Delete an announcement", $_GET["event_id"]);
        (new Announcement)->deleteAnnouncement($_POST["announcement_id"]);
        Controller::redirect("/Event/view", ["page" => "forum", "event_id" => $_GET["event_id"]]);
    }
}

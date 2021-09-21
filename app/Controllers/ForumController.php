<?php 

class ForumController{
    public function addAnnouncement()
    {
        $_POST["event_id"] = $_GET["event_id"];
        (new Announcement)->addAnnouncement($_POST);
        Controller::redirect("/Event/view", ["page" => "forum", "event_id" => $_POST["event_id"]]);
    }

    public function editAnnouncement()
    {
        $_POST["event_id"] = $_GET["event_id"];
        $announcement = new Announcement;
        $announcement->editAnnouncement($_POST);
        Controller::redirect("/Event/view", ["page" => "forum", "event_id" => $_POST["event_id"]]);
    }

    public function deleteAnnouncement()
    {
        (new Announcement)->deleteAnnouncement($_POST["announcement_id"]);
        Controller::redirect("/Event/view", ["page" => "forum", "event_id" => $_GET["event_id"]]);
    }
}
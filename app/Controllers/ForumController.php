<?php

use Stripe\Event;

class ForumController
{
    public function view($event_details)
    {
        Controller::validateForm([], ["event_id"]);
        $user_roles = Controller::accessCheck(["organization", "registered_user", "moderator", "guest_user"], $_GET["event_id"]);

        if (isset($_GET["update_announcement_id"]) && $user_roles["registered_user"]) {
            $data["announcements"] = (new Announcement)->getAnnouncement($_GET["event_id"], $_GET["update_announcement_id"]);
        } else {
            $pagination = Model::pagination("announcement", 5, "WHERE event_id= :event_id", ["event_id" => $_GET["event_id"]]);
            $data["announcements"] = (new Announcement)->getAnnouncement($_GET["event_id"], -1, $pagination["offset"], $pagination["no_of_records_per_page"]);
        }
        $data = array_merge($data, $event_details, $pagination);
        View::render("eventPage", $data, $user_roles);
    }

    public function addAnnouncement()
    {
        Controller::validateForm(["title", "announcement"], ["event_id"]);
        Controller::accessCheck(["organization", "moderator"], $_GET["event_id"]);
        $event_details = (new Events)->getDetails($_GET["event_id"]);
        (new UserController)->addActivity("Add an announcement", $_GET["event_id"]);
        $_POST["event_id"] = $_GET["event_id"];
        (new Announcement)->addAnnouncement($_POST);
        (new VolunteerController)->sendNotificationstoVolunteers("New announcement from {$event_details['event_name']}...!","/Event/view?page=forum&&event_id={$_GET["event_id"]}",$_GET["event_id"],"addAnnouncementMail",["event_name"=>$event_details['event_name']],"New announcement from {$event_details['event_name']}...!");
        Controller::redirect("/Event/view", ["page" => "forum", "event_id" => $_GET["event_id"]]);
    }

    public function editAnnouncement()
    {
        Controller::validateForm(["title", "announcement", "announcement_id"], ["event_id"]);
        Controller::accessCheck(["organization", "moderator"], $_GET["event_id"]);
        (new UserController)->addActivity("Edit an announcement", $_GET["event_id"]);
        $_POST["event_id"] = $_GET["event_id"];
        $announcement = new Announcement;
        $announcement->editAnnouncement($_POST);
        $event_details = (new Events)->getDetails($_GET["event_id"]);
        (new VolunteerController)->sendNotificationstoVolunteers("Announcement of {$event_details['event_name']} has been changed ...!","/Event/view?page=forum&&event_id={$_GET["event_id"]}",$_GET["event_id"],"editAnnouncementMail",["event_name"=>$event_details['event_name']],"Announcement of {$event_details['event_name']} has been changed ...!");
        Controller::redirect("/Event/view", ["page" => "forum", "event_id" => $_GET["event_id"]]);
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

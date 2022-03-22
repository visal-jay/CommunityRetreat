<?php

use Stripe\Event;

class ForumController
{
    public function view($event_details)
    {
        Controller::validateForm([], ["event_id"]); //checking all the required data are delivered from VIEW to function the MODEL
        $user_roles = Controller::accessCheck(["organization", "registered_user", "moderator", "guest_user"], $_GET["event_id"]); //giving access to view announcemnets to user roles except treasurer and admin

        if (isset($_GET["update_announcement_id"]) && $user_roles["registered_user"]) { //notification redirect?
            $data["announcements"] = (new Announcement)->getAnnouncement($_GET["event_id"], $_GET["update_announcement_id"]);
        } else { //general view page of announcements
            $pagination = Model::pagination("announcement", 5, "WHERE event_id= :event_id", ["event_id" => $_GET["event_id"]]);
            $data["announcements"] = (new Announcement)->getAnnouncement($_GET["event_id"], -1, $pagination["offset"], $pagination["no_of_records_per_page"]);
        }
        $data["current_date"] = gmdate("Y-m-d", (int)shell_exec("date '+%s'")); //converting date format
        $data = array_merge($data, $event_details, $pagination); //merging arrays
        View::render("eventPage", $data, $user_roles);
    }

    public function addAnnouncement()
    {
        Controller::validateForm(["title", "announcement"], ["event_id"]); 
        Controller::accessCheck(["organization", "moderator"], $_GET["event_id"]); //access check for moderator and organization
        $event_details = (new Events)->getDetails($_GET["event_id"]); //calling the function in model and retrieve existing data from backend
        (new UserController)->addActivity("Add an announcement", $_GET["event_id"]); //?
        $_POST["event_id"] = $_GET["event_id"];
        (new Announcement)->addAnnouncement($_POST); //adding a new announcement
        (new VolunteerController)->sendNotificationstoVolunteers("New announcement from {$event_details['event_name']}...!","/Event/view?page=forum&&event_id={$_GET["event_id"]}",$_GET["event_id"],"addAnnouncementMail",["event_name"=>$event_details['event_name']],"New announcement from {$event_details['event_name']}...!");
        //sending a notification to volunteers when an event post a new announcement
        Controller::redirect("/Event/view", ["page" => "forum", "event_id" => $_GET["event_id"]]);
    }

    public function editAnnouncement()
    {
        Controller::validateForm(["title", "announcement", "announcement_id"], ["event_id"]);
        Controller::accessCheck(["organization", "moderator"], $_GET["event_id"]); //access check for moderator and organization
        (new UserController)->addActivity("Edit an announcement", $_GET["event_id"]); //inserting the editing activity
        $_POST["event_id"] = $_GET["event_id"];
        $announcement = new Announcement; //creating a new Announcement object and pass it to the parameter 'announcement'
        $announcement->editAnnouncement($_POST); //requesting to perform an edit operation in database
        $event_details = (new Events)->getDetails($_GET["event_id"]); 
        (new VolunteerController)->sendNotificationstoVolunteers("Announcement of {$event_details['event_name']} has been changed ...!","/Event/view?page=forum&&event_id={$_GET["event_id"]}",$_GET["event_id"],"editAnnouncementMail",["event_name"=>$event_details['event_name']],"Announcement of {$event_details['event_name']} has been changed ...!");
        //sending a notification to already volunteered users when there is an edit of an existing announcement
        Controller::redirect("/Event/view", ["page" => "forum", "event_id" => $_GET["event_id"]]);
    }

    public function deleteAnnouncement()
    {
        Controller::validateForm(["announcement_id"], ["event_id"]);
        Controller::accessCheck(["organization", "moderator"], $_GET["event_id"]); //access check for moderator and organization
        (new UserController)->addActivity("Delete an announcement", $_GET["event_id"]); //inserting the deleting activity
        (new Announcement)->deleteAnnouncement($_POST["announcement_id"]); //requesting for a delete operation in the database
        Controller::redirect("/Event/view", ["page" => "forum", "event_id" => $_GET["event_id"]]);
    }
}

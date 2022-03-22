<?php
//use Defuse\Crypto\File;

class OrganisationController
{
    //organization header render for non-orgnazational users
    public function view()
    {
        Controller::validateForm([], ["org_id", "page"]);
        $user_roles = Controller::accessCheck(["registered_user", "guest_user", "admin"]);
        $org_id = $_GET["org_id"];
        $data = (new Organisation)->getDetails($org_id); //get orgainzation details
        View::render("organisationDashboard", $data, $user_roles);
        if ($_GET["page"] == "gallery")
            $this->gallery();
        elseif ($_GET["page"] == "events")
            $this->events();
    }

    //organization dashboard for the organizarion user
    public function dashboard()
    {
        $user_roles = Controller::accessCheck(["organization"]);
        $data = (new Organisation)->getDetails($_SESSION["user"]["uid"]); //get orgainzation details
        View::render("organisationDashboard", $data, $user_roles);
    }

    public function addPhoto()
    {
        (new UserController)->addActivity("You added photo to gallery"); //add user activity "photo uploaded"
        (new Gallery)->addPhoto([], true);  //add the photo
        echo "success"; //send ajax response that upload was success
    }


    public function gallery()
    {
        if (isset($_GET["org_id"])) {
            $user_roles = Controller::accessCheck(["registered_user", "guest_user"]);
            $org_id = $_GET["org_id"];
        } else {
            $user_roles = Controller::accessCheck(["organization"]);
            $org_id = $_SESSION["user"]["uid"];
        }
        $pagination = Model::pagination("organization_gallery", 12, " WHERE uid = :uid", ["uid" => $org_id]); // get photos 12 per page
        if (!$data = (new Gallery)->getGallery(["uid" => $org_id, "offset" => $pagination["offset"], "no_of_records_per_page" => $pagination["no_of_records_per_page"]], true))
            $data = array();

        View::render("organisationGallery", array_merge(["photos" => $data], $pagination), $user_roles);
    }

    public function deletePhoto()
    {
        Controller::accessCheck(["organization"]);
        Controller::validateForm(["photo"]);
        (new UserController)->addActivity("you deleted photo from gallery"); //add user activity "photo deleted"
        (new Gallery)->deletePhoto(["image" => $_POST["photo"]], true); // delete the photo
        Controller::redirect("/Organisation/gallery");
    }

    public function update()
    {
        Controller::validateForm(["about_us", "longitude", "latitude"]);
        Controller::accessCheck(["organization"]);
        (new UserController)->addActivity("You updated dashboard details"); //add user activity "Updated details"
        (new Organisation)->updateDetails($_SESSION["user"]["uid"], $_POST);    //Update organizational dashboard
        Controller::redirect("/Organisation/dashboard");
    }

    public function events()
    {
        $events = new Events;

        if (isset($_GET["org_id"]))
            $user_roles = Controller::accessCheck(["registered_user", "guest_user"]);
        else
            $user_roles = Controller::accessCheck(["organization"]);

        $org_id = isset($_GET["org_id"]) ? $_GET["org_id"] : $_SESSION["user"]["uid"];
        //if user is organization or a admin show "added","published","ended" events
        if ($user_roles["organization"] || $user_roles["admin"]) {
            $pagination = Model::pagination("event_details", 10, " WHERE org_uid = :org_uid AND NOT status = :status ", ["status" => "deleted", "org_uid" => $org_id]);
            $data["events"] = $events->query(["org_uid" => $org_id, "status" => ["deleted"], "not_status" => TRUE, "order_type" => "event_id", "offset" => $pagination["offset"], "limit" => $pagination["no_of_records_per_page"]]);
        }
        //if user is not organization show "published","ended" events
        else {
            $pagination = Model::pagination("event_details", 10, " WHERE org_uid = :org_uid AND status = :status_1 OR status = :status_2 ", ["status_1" => "published", "status_2" => "ended", "org_uid" => $org_id]);
            $data["events"] = $events->query(["org_uid" => $org_id, "status" => ["ended", "published"], "order_type" => "event_id", "offset" => $pagination["offset"], "limit" => $pagination["no_of_records_per_page"]]);
        }

        if (!$data["events"])
            $data["events"] = array();
        $data = array_merge($data, $pagination);
        View::render("manageEvents", $data, $user_roles);
    }

    public function report()
    {
        $user_roles = Controller::accessCheck(["organization"]);
        $organisation = new Organisation;
        $data["donation"] = $organisation->donationReport();
        $data["donation_percent"] = $organisation->donationPercentageReport();
        $data["volunteer"] = $organisation->volunteerReport();
        $data["volunteer_percent"] = $organisation->volunteerPercentageReport();
        View::render("report", $data, $user_roles);
    }



    public function profile()
    {
        $user_roles = Controller::accessCheck(["organization"]);
        $organisation_admin = new Organisation();
        $uid = $_SESSION["user"]["uid"];
        $org_admin_details = $organisation_admin->getDetails($uid);
        $encryption = new Encryption();
        if ($org_admin_details['account_number'] != NULL) {
            $account = $encryption->decrypt($org_admin_details['account_number'], "account details");
            $org_admin_details["account_number"] = $account["account_number"];
        }
        View::render('organisationProfile', $org_admin_details, $user_roles);
    }

    public function activityLog()
    {
        $user_roles = Controller::accessCheck(["organization"]);
        View::render('history', [], $user_roles);
    }


    public function updateAccountNumber()
    {
        Controller::validateForm(["bank_name", "account_number"]);
        Controller::accessCheck(["organization"]);
        $encryption = new Encryption();
        $organisation_admin = new Organisation();
        $validate = new Validation();
        $uid = $_SESSION["user"]["uid"];
        $account_number = $encryption->encrypt(["account_number" => $_POST['account_number']], "account details");
        $data = ["uid" => $uid, "bank_name" => $_POST['bank_name'], "account_number" => $account_number];
        if ($validate->bankaccount($_POST['account_number'])) {
            $organisation_admin->changeAccountNumber($uid, $data);
            (new UserController)->addActivity("you updated your bank details");
            Controller::redirect("/Organisation/profile");
        }
    }

    //get available users for userroles
    function getAvailableUserRoles()
    {
        echo json_encode((new Organisation)->getAvailableUserRoles($_POST["name"]));
    }

    function addUserRole()
    {
        Controller::validateForm(["role", "uid"], ["event_id"]);
        $user_roles = Controller::accessCheck(["organization"]);
        $userController = new UserController();
        (new Organisation)->addUserRole($_POST["uid"], $_POST["role"], $_GET["event_id"]); //add user to the assigned userrole
        $event_details = (new Events)->getDetails($_GET["event_id"]);  //get event details
        $userController->addActivity("User role added for {$event_details['event_name']}", $_GET["event_id"]);  //Add activity that userrole was created

        //Send notification to user user role "treasurer"
        if ($_POST["role"] == "Treasurer")
            $userController->sendNotifications("You have been assigned as a treasurer for {$event_details['event_name']} event By {$event_details['organisation_username']}.", $_POST["uid"], "event", "window.location.href='/Event/view?page=about&&event_id={$_GET["event_id"]}'", $_GET["event_id"], "addUserRoleMail", ["event_name" => $event_details['event_name'], "organisation_username" => $event_details['organisation_username'], "position" => "Treasurer"], "You are now a treasurer..!");
        //Send notification to user user role "moderator"
        else if ($_POST["role"] == "Moderator")
            $userController->sendNotifications("You have been assigned as a moderator for {$event_details['event_name']} event By {$event_details['organisation_username']}.", $_POST["uid"], "event", "window.location.href='/Event/view?page=about&&event_id={$_GET["event_id"]}'", $_GET["event_id"], "addUserRoleMail", ["event_name" => $event_details['event_name'], "organisation_username" => $event_details['organisation_username'], "position" => "Moderator"], "You are now a moderator..!");
        Controller::redirect("/Event/view", ["page" => 'userroles', "event_id" => $_GET["event_id"], $user_roles]);
    }


    function deleteUserRole()
    {
        Controller::validateForm(["role", "uid"], ["event_id"]);
        $user_roles = Controller::accessCheck(["organization", "admin"]);
        $userController = new UserController();
        (new Organisation)->deleteUserRole($_POST["uid"], $_POST["role"], $_GET["event_id"]); //delete user to the assigned userrole
        $event_details = (new Events)->getDetails($_GET["event_id"]);   //get event details
        $userController->addActivity("User role deleted from {$event_details['event_name']}", $_GET["event_id"]);   //Add activity that userrole was deleted
        //Send notification to user user role "treasurer"
        if ($_POST["role"] == "treasurer")
            $userController->sendNotifications("You have been removed from the treasurer position of {$event_details['event_name']} event By {$event_details['organisation_username']}.", $_POST["uid"], "event", "window.location.href='/Event/view?page=about&&event_id={$_GET["event_id"]}'", $_GET["event_id"], "removeUserRoleMail", ["event_name" => $event_details['event_name'], "organisation_username" => $event_details['organisation_username'], "position" => "Treasurer"], "You are no longer a treasurer..!");
        //Send notification to user user role "moderator"
        else if ($_POST["role"] == "moderator")
            $userController->sendNotifications("You have been removed from the treasurer position of {$event_details['event_name']} event By {$event_details['organisation_username']}.", $_POST["uid"], "event", "window.location.href='/Event/view?page=about&&event_id={$_GET["event_id"]}'", $_GET["event_id"], "removeUserRoleMail", ["event_name" => $event_details['event_name'], "organisation_username" => $event_details['organisation_username'], "position" => "Moderator"], "You are no longer a moderator..!");
        Controller::redirect("/Event/view", ["page" => 'userroles', "event_id" => $_GET["event_id"], $user_roles]);
    }
}

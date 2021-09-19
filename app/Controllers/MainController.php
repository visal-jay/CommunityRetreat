<?php

class MainController
{
    public function index()
    {
        if (isset($_SESSION["user"]["user_type"])) {
            $user_type = $_SESSION["user"]["user_type"];
            if ($user_type == "organization")
                Controller::redirect("/Organisation/dashboard");
            elseif ($user_type == "registered_user")
                Controller::redirect("/User/home");
            elseif ($user_type == "admin")
                Controller::redirect("/view/organisationDashboard.php");
        } else
            Controller::redirect("User/home");
    }
}

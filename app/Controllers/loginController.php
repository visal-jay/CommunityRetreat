<?php
class LoginController
{

    function view()
    {
        $_GET["signup"] = isset($_GET["signup"]) ? true : false;
        $_GET["login"] = $_GET["signup"] == true ? false : true;
        $_GET["signupOrg"] = isset($_GET["signupOrg"]) ? true : false;
        $_GET["signupUser"] = $_GET["signupOrg"] == true ? false : true;
        $_GET = array_merge(["passwordErr" => '', "emailErr" => ''], $_GET);
        View::render("login");
    }

    //http://localhost/login/view?emailErr=Invalid+email&passwordErr=Invalid+password&signup=1&signupOrg=1

    function fogotPassword()
    {
        $organisation = new Organisation();
        $registered_user = new RegisteredUser();
        //$admin = new Administrator();
        if ($organisation->checkUserEmail($_POST["email"])) {
            $data["emailErr"] = "Email already taken";
        } elseif ($registered_user->checkUserEmail($_POST["email"])) {
            $data["emailErr"] = "Email already taken";
        }
    }

    public static function validate ($email='',$password='')
    {
        if (isset($_POST["email"]) AND isset($_POST["password"]))
            extract($_POST, EXTR_SKIP);

        $user=new User;
        if ($user_details=$user->authenticate($email, $password)) {
            session_start();
            $_SESSION=array_intersect_key($user_details,["uid"=>'',"user_type"=>'']);
            $user_type=$user_details["user_type"];
            if ($user_type=="organization")
                Controller::redirect("/view/organisationDashboard.php");
            elseif ($user_type=="registereduser")
                Controller::redirect("/view/organisationDashboard.php");
            elseif($user_type=="admin")
                Controller::redirect("/view/organisationDashboard.php");
        } 
        else
            Controller::redirect("login/view");
    }
}

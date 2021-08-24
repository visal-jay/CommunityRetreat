<?php

use LoginController as GlobalLoginController;

class LoginController
{

    function view()
    {
        $_GET["signup"] = isset($_GET["signup"]) ? true : false;
        $_GET["login"] = $_GET["signup"] == true ? false : true;
        $_GET["signupOrg"] = isset($_GET["signupOrg"]) ? true : false;
        $_GET["signupUser"] = $_GET["signupOrg"] == true ? false : true;
        $_GET = array_merge(["passwordErr" => '', "emailErr" => '', "loginErr" => ''], $_GET);
        View::render("login");
    }

    function forgotPassword()
    {
        if (isset($_POST["email"])) {
            $user = new User;
            if ($user->checkUserEmail($_POST["email"])) {
                $key = $user->getForgotPasswordKey($_POST["email"]);
                $mail = new Mail;
                $mail->verificationEmail($_POST["email"], "forgotPasswordMail", "localhost/login/validateforgotpassword?" . http_build_query(["key" => $key]), 'Reset password');
                // UI
            }
        }
        Controller::redirect('/login/view');
    }

    function validateForgotPassword()
    {
        if(!isset($_GET["key"]))
            Controller::redirect('/login/view');
        $key = $_GET["key"];
        $encyption = new Encryption;
        $data = $encyption->decrypt($key, 'reset password');
        $time = (int)shell_exec("date '+%s'");
        $user = new User;
        $user_details = $user->authenticate($data["email"], $data["password"]);
        if ($user_details && $data["time"] > $time - 3600) {
            View::render("resetPassword",["key"=>$key]);
        } else
            Controller::redirect('/login/view');
    }

    function resetPassword()
    {
        if(!isset($_GET["key"]))
            Controller::redirect('/login/view');
        $key = $_GET["key"];
        $encyption = new Encryption;
        $data = $encyption->decrypt($key, 'reset password');
        (new User)->resetPassword($data["email"],$_POST["password"]);
        Controller::redirect("/login/view");
    }

    public static function validate($email = '', $password = '')
    {
        if (isset($_POST["email"]) and isset($_POST["password"]))
            extract($_POST, EXTR_OVERWRITE);

        $user = new User;
        if (($user->checkLoginAcess($email)))
            Controller::redirect("/login/view", ["loginErr" => 'You are currently locked out<br>Try again later', "loginDenied" => true]);

        if ($user_details = $user->authenticate($email, $password)) {
            session_start();
            $_SESSION["user"] = array_intersect_key($user_details, ["uid" => '', "user_type" => '']);
            $user_type = $user_details["user_type"];

            if ($user_type == "organization")
                Controller::redirect("/organisation/dashboard");
            elseif ($user_type == "registereduser")
                Controller::redirect("/view/organisationDashboard.php");
            elseif ($user_type == "admin")
                Controller::redirect("/view/organisationDashboard.php");
        } else (new LoginController)->loginFailed($email);
    }

    private function loginFailed($email)
    {
        $bad_login_limit = 5;
        $lockout_time = 600;
        $user = new User;
        $time = (int)shell_exec("date '+%s'");
        if ($failed_login_details = $user->getFailedlogin($email))
            extract($failed_login_details, EXTR_SKIP);
        else
            Controller::redirect("/login/view", ["loginErr" => 'Incorrect username or password']);

        if (($failed_login_count >= $bad_login_limit) && ($time - $first_failed_login < $lockout_time)) {
            Controller::redirect("/login/view", ["loginErr" => 'You are currently locked out<br>Try again later', "loginDenied" => true]);
        } else {
            if ($time - $first_failed_login > $lockout_time) {
                $first_failed_login = $time;
                $failed_login_count = 1;
            } else {
                $failed_login_count++;
            }
            $user->updateFailedLogin($email, $failed_login_count, $first_failed_login);
            Controller::redirect("/login/view", ["loginErr" => 'Incorrect username or password']);
        }
    }
}

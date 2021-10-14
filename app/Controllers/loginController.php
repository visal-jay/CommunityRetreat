<?php

use LoginController as GlobalLoginController;

class LoginController
{

    function view()
    {
        /* if user is logged in redirect to respective home */
        if(isset($_SESSION["user"]))
            Controller::redirect("/User/home");

        $user_roles=Controller::accessCheck(["guest_user"]);
        $_GET["signup"] = isset($_GET["signup"]) ? true : false;
        $_GET["login"] = $_GET["signup"] == true ? false : true;
        $_GET["signupOrg"] = isset($_GET["signupOrg"]) ? true : false;
        $_GET["signupUser"] = $_GET["signupOrg"] == true ? false : true;

       
        if(isset($_GET["redirect"]))
            $_SESSION["redirect"] = $_GET["redirect"];
        else if (isset($_SERVER['HTTP_REFERER']))
            $_SESSION["redirect"] = $_SERVER['HTTP_REFERER'];
        
        View::render("login",[],$user_roles);
    }

    /* send key to reset the password */
    function forgotPassword()
    {
        if (isset($_POST["email"])) {
            $user = new User;
            if ($user->checkUserEmail($_POST["email"])) {
                $key = $user->getForgotPasswordKey($_POST["email"]);
                $mail = new Mail;
                $mail->verificationEmail($_POST["email"], "forgotPasswordMail", "https://www.communityretreat.me/Login/validateforgotpassword?" . http_build_query(["key" => $key]), 'Reset password');
            }
            Controller::redirect('/Login/view',["forgot_password"=>true,"mail"=>true]);
        }
        else{
            Controller::redirect("/Login/view");
        }
    }

    /* validate the forgot password key and reedirecting to restting password */
    function validateForgotPassword()
    {
        if(!isset($_GET["key"]))
            Controller::redirect('/Login/view');
        $key = $_GET["key"];
        $encyption = new Encryption;
        $data = $encyption->decrypt($key, 'reset password');
        $time = (int)shell_exec("date '+%s'");
        $user = new User;
        $user_details = $user->authenticateWithMails($data["email"], $data["password"],1,1);
        if ($user_details && $data["time"] > $time - 3600) {
            View::render("resetPassword",["key"=>$key]);
        } else
            Controller::redirect('/Login/view');
    }

    /* reset password and redirecting to login page */
    function resetPassword()
    {
        if(!isset($_GET["key"]))
            Controller::redirect('/Login/view');
        $key = $_GET["key"];
        $encyption = new Encryption;
        $data = $encyption->decrypt($key, 'reset password');
        (new User)->resetPassword($data["email"],$_POST["password"]);
        Controller::redirect("/Login/view");
    }

    /* validate login */
    public static function validate()
    {
        Controller::validateForm(["email","password"]);
        extract($_POST, EXTR_OVERWRITE);

        $user = new User;
        if (($user->checkLoginAcess($email)))
            Controller::redirect("/Login/view", ["loginErr" => 'You are currently locked out<br>Try again later', "loginDenied" => true,"login"=>true]);

        if ($user_details = $user->authenticate($email, $password)) {
            $user_details["username"]=$user->getUsername($user_details["uid"]);
            $_SESSION["user"] = array_intersect_key($user_details, ["uid" => '', "user_type" => '',"username"=>'']);
            if(isset($_SESSION["redirect"])){
                $redirect = $_SESSION["redirect"] ;
                unset($_SESSION["redirect"]);
                header("Location:".$redirect, true,  302);
                exit();
            }
            else
                Controller::redirect("/User/home");
        } 
        else (new LoginController)->loginFailed($email);
    }


    /* logout and destroy session */
    public function logout(){
        if(!isset($_SESSION)) session_start();
        session_destroy();
        Controller::redirect('/Login/view');
    }

    private function loginFailed($email)
    {
        /* after 5 bad logins account is locked for 10 minutes */
        $bad_login_limit = 5;
        $lockout_time = 600;
        $user = new User;
        $time = (int)shell_exec("date '+%s'");
        if ($failed_login_details = $user->getFailedlogin($email))
            extract($failed_login_details, EXTR_SKIP);
        else
            Controller::redirect("/Login/view", ["loginErr" => 'Incorrect username or password',"login"=> true]);

        if (($failed_login_count >= $bad_login_limit) && ($time - $first_failed_login < $lockout_time)) {
            Controller::redirect("/Login/view", ["loginErr" => 'You are currently locked out<br>Try again later', "loginDenied" => true,"login"=> true]);
        } else {
            if ($time - $first_failed_login > $lockout_time) {
                $first_failed_login = $time;
                $failed_login_count = 1;
            } else {
                $failed_login_count++;
            }
            $user->updateFailedLogin($email, $failed_login_count, $first_failed_login);
            Controller::redirect("/Login/view", ["loginErr" => 'Incorrect username or password']);
        }
    }
}


<?php
class LoginController
{

    function view()
    {
        $_GET["signup"]=isset($_GET["signup"])?true:false;
        $_GET["login"]= $_GET["signup"]==true?false:true;
        $_GET["signupOrg"]=isset($_GET["signupOrg"])?true:false;
        $_GET["signupUser"]=$_GET["signupOrg"]==true?false:true;
        $_GET=array_merge(["passwordErr"=>'',"emailErr"=>''],$_GET);
        View::render("login");
    }
}

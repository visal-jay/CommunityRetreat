<?php

class MainController
{
    public function index()
    {
        Controller::redirect("/User/home");
    }

    public function aboutUs()
    {
        $user_roles = Controller::accessCheck(["organization","registered_user","guest_user"]);
        View::render("aboutUs",$user_roles);
    }

    public function contactUs()
    {
        $user_roles = Controller::accessCheck(["organization","registered_user","guest_user"]);
        View::render("contactUs",$user_roles);
    }

    public function contactEmail()
    {
        Controller::validateForm(["message","name","email","contact_no"], []); 
        $user_roles = Controller::accessCheck(["organization","registered_user","guest_user"]);
        $data= $_POST;
        (new Mail)->contactUsEmail("contactEmail", $data);
        Controller::redirect("/Main/index");
    }


    public function termsandconditions()
    {
        $user_roles = Controller::accessCheck(["organization","registered_user","guest_user"]);
        View::render("terms&conditions",$user_roles);
    }
}

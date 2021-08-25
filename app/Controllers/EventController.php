<?php
class EventController{

    public function view(){
        if (isset($_GET["event_id"])){
            $register_user=new RegisteredUser;
            $event=new Events;
                if(!isset($_SESSION)) 
                    session_start();
                $uid=$_SESSION["user"]["uid"];
                if(!$event_details=$event->getDetails($_GET["event_id"])){      
                /* $user_roles=$register_user->getUserRoles($uid,$_GET["event_id"]);
                $data=array_merge($event_details,$user_roles); */
                $data=$event_details;
                View::render("aboutEvent",$data);
            }
        }
        else
            View::render("home");

            
    }


    public function addEvent(){
        $validate=new Validation;

        var_dump($_POST);
        (new Events)->addEvent($_POST);
    }

    public function updateDetails()
    {
        Controller::accessCheck(["moderator","organization"],$_GET["event_id"]);
        $validate=new Validation;
        if(!$validate->telephone($_POST["telephone"]))
        {
            $data["telephoneErr"]="You ebeterd wrong number";
        }
        if(isset($data["emailErr"]))
            Controller::redirect("/event/view",$data);

        $events=new Events;
        $events->updateDetails($_POST);
        Controller::redirect("event/view");
    }

  
}
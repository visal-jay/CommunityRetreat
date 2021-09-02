<?php

//use Defuse\Crypto\File;

class OrganisationController{
    public function view($org_id=''){

        $org_id= isset($_GET["org_id"]) ? $_GET["org_id"] : $org_id;
        $data= (new Organisation)->getDetails($org_id);
        View::render("organisationDashboard",$data);
    }

    public function dashboard(){
        $this->view($_SESSION["user"]["uid"]);
    }

    public function addPhoto(){
        (new Gallery)->addPhoto([],true);
        Controller::redirect("/organisation/gallery");
    }


    public function gallery(){
        if (!$data=(new Gallery)->getGallery(["uid"=>$_SESSION["user"]["uid"]],true))
            $data=array();

        View::render("organisationGallery",array_merge(["photos"=>$data]));
    }

    public function deletePhoto(){
        (new Gallery)->deletePhoto(["image"=>$_POST["photo"]],true);
        Controller::redirect("/organisation/gallery");
    }

    public function update(){
        Controller::accessCheck(["organization"]);
        $validate = new Validation();
        if (!$validate->telephone($_POST["contact_number"]))
           $error=["telephone"=>"Wrong telephone number","error"=>true];
        if(isset($error))
            Controller::redirect("/organisation/dashboard",$error);
        (new Organisation)->updateDetails($_SESSION["user"]["uid"],$_POST);
        Controller::redirect("/Organisation/dashboard");
    }

    public function events(){
        if(!isset($_SESSION))
            session_start();
        $event=new Events;
        $data["events"]=array();
        if($result=$event->query(["org_uid"=> $_SESSION["user"]["uid"],"status"=>"published"]))
            array_push($data["events"],$result[0]);
        if($result=$event->query(["org_uid"=> $_SESSION["user"]["uid"],"status"=>"added"]))
        array_push($data["events"],$result[0]);

        usort($data["events"], function($a, $b) {
            return $a['event_id'] <=> $b['event_id'];
        });

        View::render("manageEvents",$data);
    }

    public function report(){
        View::render("report");
    }


}
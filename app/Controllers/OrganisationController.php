<?php
session_start();

class OrganisationController{
    public function view($org_id=''){
        $org_id= isset($_GET["orgId"]) ? $_GET["orgId"] : $org_id;
        $data= (new Organisation)->getDetails($org_id);
        View::render("organisationDashboard",$data);
    }

    public function dashboard(){
        $this->view($_SESSION["user"]["uid"]);
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
}
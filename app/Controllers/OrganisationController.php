<?php
//session_start();

class OrganisationController{
    public function view($org_id=''){

        $org_id= isset($_GET["org_id"]) ? $_GET["org_id"] : $org_id;
        $data= (new Organisation)->getDetails($org_id);
        View::render("organisationDashboard",$data);
    }

    public function dashboard(){
        $this->view($_SESSION["user"]["uid"]);
    }

    public function gallery(){
        View::render("organisationGallery");
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

    public function organizationalAdminProfileView(){
        $organisation_admin=new Organisation();
        $_SESSION["user"]["uid"]='ORG0000024';
        $uid=$_SESSION["user"]["uid"];
        $org_admin_details=$organisation_admin-> getAdminDetails($uid); 
        View::render('organisationProfile',$org_admin_details);

    }
    public function updateUsername(){

        $organisation_admin= new Organisation();
        $_SESSION["user"]["uid"]='ORG0000024';
        $uid=$_SESSION["user"]["uid"];
        $organisation_admin->changeUsername($uid,$_POST['username']);
        Controller::redirect("/Organisation/organizationalAdminProfileView");
        
    }
    public function updateContactNumber(){

        $validate = new Validation();
        $organisation_admin = new Organisation();
        $_SESSION["user"]["uid"]='ORG0000024';
        $uid=$_SESSION["user"]["uid"];
        $data = [ "contact_number"=> $_POST['contact_number']];
        if (!$validate->telephone($_POST["contact_number"])){
            $error["telephoneerr"] = "+94XXXXXXXXX";
        }   
        if(isset($error)) {

            View::render('organisationProfile',$error);
        }          
            
        else
            
            $organisation_admin->changeContactNumber($uid,$data);
            Controller::redirect("/Organisation/organizationalAdminProfileView");
        
    }

    public function updateEmail(){

        $organisation_admin = new Organisation();
        $user = new User();
        $validate =new Validation();
        $_SESSION["user"]["uid"]='ORG0000024';
        $uid=$_SESSION["user"]["uid"];
        $data = ["email"=>$_POST['email']];
        if(!$validate->email($_POST["email"])){
            $error["invaliderr"] = "Invalid email";
        }
        if($user->checkUserEmail($_POST["email"])) {
            $error["emailErr"] = "Email already taken";
        }
        if(isset($error["invaliderr"])){
            Controller::redirect("/Organisation/organizationalAdminProfileView",$error);
        }
        else
            $organisation_admin->changeEmail($uid,$data);
            Controller::redirect("/Organisation/organizationalAdminProfileView");
        
    }
    public function updatePassword(){
        $organisation_admin = new Organisation();
        $user = new User();
        $validate =new Validation();
        $_SESSION["user"]["uid"]='ORG0000024';
        $uid=$_SESSION["user"]["uid"];
        $data = ["uid"=>$_POST['uid'],"password"=>$_POST['password']];
        if(!$organisation_admin->checkCurrentPassword($uid,$_POST['current_password'])){
            $error1=["currentpassworderr"=>"Password incorrect"];
            Controller::redirect("/Organisation/organizationalAdminProfileView", $error1);
        }
        if(!$validate->password($_POST["new_password"])) {
            $error2 = ["newpassworderr"=>"Strong password required<br> Combine least 8 of the following: uppercase letters,lowercase letters,numbers and symbols"];
            Controller::redirect("/Organisation/organizationalAdminProfileView",$error2);
        }
        else{
            $organisation_admin->changePassword($uid,$data);
            Controller::redirect("/Organisation/organizationalAdminProfileView");

        }
                
    }
    public function updateAccountNumber(){
        $organisation_admin = new Organisation();
        $validate =new Validation();
        $_SESSION["user"]["uid"]='ORG0000024';
        $uid=$_SESSION["user"]["uid"];
        $data=["uid"=>$uid,"account_number"=>$_POST['account_number']];
        if($validate-> bankaccount($_POST['account_number'])){
          $organisation_admin->changeAccountNumber($uid,$data);
          Controller::redirect("/Organisation/organizationalAdminProfileView");
        }

    }
    function checkEmailAvailable(){
        if((new Validation)->email($_POST["email"]));
        echo json_encode(array("taken"=>(new User)->checkUserEmail($_POST["email"])));
    }

}
<?php

//use Defuse\Crypto\File;

class OrganisationController
{
    public function view($org_id = '')
    {
        if($org_id!='')
            $user_roles=Controller::accessCheck(["registered_user","guest_user"]);
        else
            $user_roles=Controller::accessCheck(["organization","registered_user","guest_user"]);

        $org_id = isset($_GET["org_id"]) ? $_GET["org_id"] : $org_id;
        if($data = (new Organisation)->getDetails($org_id))
            View::render("organisationDashboard", $data,$user_roles);
            
    }

    public function dashboard()
    {
        $this->view($_SESSION["user"]["uid"]);
    }

    public function addPhoto()
    {
        (new Gallery)->addPhoto([], true);
        Controller::redirect("/organisation/gallery");
    }


    public function gallery()
    {
        if(isset($_GET["org_id"]))
            $user_roles=Controller::accessCheck(["registered_user","guest_user"]);
        else
            $user_roles=Controller::accessCheck(["organization","registered_user","guest_user"]);

        $org_id = isset($_GET["org_id"]) ? $_GET["org_id"] : $_SESSION["user"]["uid"];

        if (!$data = (new Gallery)->getGallery(["uid" => $org_id], true))
            $data = array();

        View::render("organisationGallery", array_merge(["photos" => $data]),$user_roles);
    }

    public function deletePhoto()
    {
        (new Gallery)->deletePhoto(["image" => $_POST["photo"]], true);
        Controller::redirect("/organisation/gallery");
    }

    public function update()
    {
        Controller::accessCheck(["organization"]);
        $validate = new Validation();
        
        (new Organisation)->updateDetails($_SESSION["user"]["uid"], $_POST);
        Controller::redirect("/Organisation/dashboard");
    }

    public function events()
    {
        if(isset($_GET["org_id"]))
            $user_roles=Controller::accessCheck(["registered_user","guest_user"]);
        else
            $user_roles=Controller::accessCheck(["organization","registered_user","guest_user"]);

        $org_id = isset($_GET["org_id"]) ? $_GET["org_id"] : $_SESSION["user"]["uid"];

        $events = new Events;
        $data["events"] = array();
        if ($result = $events->query(["org_uid" => $org_id, "status" => "published"]))
            foreach ($result as $event)
                array_push($data["events"], $event);
        if ($result = $events->query(["org_uid" => $org_id, "status" => "added"]))
            foreach ($result as $event)
                array_push($data["events"], $event);

        usort($data["events"], function ($a, $b) {
            return $a['event_id'] <=> $b['event_id'];
        });
        View::render("manageEvents", $data,$user_roles);
    }

    public function report()
    {
        $organisation = new Organisation;
        $data["donation"]= $organisation->donationReport();
        $data["donation_percent"]=$organisation->donationPercentageReport();
        $data["volunteer"]= $organisation->volunteerReport();
        $data["volunteer_percent"]=$organisation->volunteerPercentageReport();
        View::render("report",$data);
    }


    public function organizationalAdminProfileView(){
        $organisation_admin=new Organisation();
        $uid=$_SESSION["user"]["uid"];
        $org_admin_details=$organisation_admin-> getAdminDetails($uid); 
        View::render('organisationProfile',$org_admin_details);

    }
    public function updateUsername(){

        $organisation_admin= new Organisation();
        $uid=$_SESSION["user"]["uid"];
        $organisation_admin->changeUsername($uid,$_POST['username']);
        Controller::redirect("/Organisation/organizationalAdminProfileView");
        
    }
    public function updateContactNumber(){

        $validate = new Validation();
        $organisation_admin = new Organisation();
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

    function getAvailableUserRoles(){
        echo json_encode((new Organisation)->getAvailableUserRoles($_POST["name"]));
    }

    

    function addUserRole(){
        if (isset($_POST["uid"]) && isset($_POST["role"]) && isset($_GET["event_id"]))
            (new Organisation)->addUserRole($_POST["uid"],$_POST["role"],$_GET["event_id"]);
        Controller::redirect("/event/view",["page"=>'userroles',"event_id"=>$_GET["event_id"]]);
    }

    function deleteUserRole(){
        if (isset($_POST["uid"]) && isset($_POST["role"]) && isset($_GET["event_id"]))
            (new Organisation)->deleteUserRole($_POST["uid"],$_POST["role"],$_GET["event_id"]);
        Controller::redirect("/event/view",["page"=>'userroles',"event_id"=>$_GET["event_id"]]);
    }
               
}

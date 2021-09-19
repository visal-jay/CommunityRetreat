<?php
//use Defuse\Crypto\File;

class OrganisationController
{
    public function view($org_id = '')
    {
        $user_roles=Controller::accessCheck(["organization"]);
        $org_id = isset($_GET["org_id"]) ? $_GET["org_id"] : $org_id;
        $data = (new Organisation)->getDetails($org_id);
        View::render("organisationDashboard", $data,$user_roles);
    }

    public function dashboard()
    {
        $this->view($_SESSION["user"]["uid"]);
    }

    public function addPhoto()
    {
        (new Gallery)->addPhoto([], true);
        Controller::redirect("/Organisation/gallery");
    }


    public function gallery()
    {
        if(isset($_GET["org_id"])){
            $user_roles=Controller::accessCheck(["registered_user","guest_user"]);
            $org_id=$_GET["org_id"];
            }        
        else{
                $user_roles=Controller::accessCheck(["organization"]);
                $org_id = $_SESSION["user"]["uid"];
            }

        if (!$data = (new Gallery)->getGallery(["uid" => $org_id], true))
            $data = array();

        View::render("organisationGallery", array_merge(["photos" => $data]),$user_roles);
    }

    public function deletePhoto()
    {
        (new Gallery)->deletePhoto(["image" => $_POST["photo"]], true);
        Controller::redirect("/Organisation/gallery");
    }

    public function update()
    {
        Controller::accessCheck(["organization"]);
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
        $user_roles=Controller::accessCheck(["organization"]);
        $event = new Events;
        $donations = new Donations;
        $data["donation"]=json_encode([]);
        if ($result = $event->query(["org_uid" => $_SESSION["user"]["uid"], "status" => "published" ,"donation_capacity"=>true]))
            foreach ($result as $event){
                if ($donation_details = $donations->getReport(["event_id" => $event["event_id"]])) {
        
                    $start_time = strtotime($donation_details[0]["day"]);
                    $start_date=date("d", $start_time);
                    $start_month = date("m", $start_time);
                    $start_year = date("Y", $start_time);
                    $end_time = strtotime($donation_details[count($donation_details) - 1]["day"]);
                    $end_date=date("d", $end_time);
                    $end_month=date("m", $end_time);
                    $end_year = date("Y", $end_time);
                    //var_dump($end_date,$end_month, $end_year);
                    
                    $temp=array();
                    for ($year=$start_year ; $year<=$end_year ; $year++){
                        $loop_start_month = ($year==$start_year) ? $start_month : 0;
                        $loop_end_month = ($year==$end_year) ? $end_month : 12;
                        for ($month = $loop_start_month ; $month <= $loop_end_month ; $month++){
                            $loop_start_date= ($year==$start_year && $month==$start_month) ? $start_date : 1 ;
                            $loop_end_date= ($year==$end_year && $month==$end_month) ? $end_date : cal_days_in_month(CAL_GREGORIAN,$month,$year) ;
                            for ($day = $loop_start_date ; $day <= $loop_end_date ; $day++)
                                $temp["$year-". str_pad($month,2,"0", STR_PAD_LEFT) ."-".str_pad($day,2,"0", STR_PAD_LEFT)]=0;
                        }
                    }

                    foreach ($donation_details as $donation_detail)
                        $temp[$donation_detail["day"]]=$donation_detail["donation_sum"];
                        

                    $count=$i=1;
                    $sum=0;
                    $data["events"][$event["event_name"]]=array();
                    foreach ($temp as $key => $value){
                        $sum+=$value;
                        if($i==7)
                        {
                            $data["events"][$event["event_name"]]["donations"]["week $count"]=$sum;
                            $sum=$i=0; 
                            $count++;
                        }
                        $i++;
                    }
                    if(count($temp)%7!=0)
                        $data["events"][$event["event_name"]]["donations"]["week $count"]=$sum;
                        
                    unset($temp);
                }
                $data["events"][$event["event_name"]]["donations_percent"]=$event["donation_percent"];
                $data["events"]= json_encode($data["events"]);
            }
        View::render("report",$data,$user_roles);
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
        Controller::redirect("/Event/view",["page"=>'userroles',"event_id"=>$_GET["event_id"]]);
    }

    function deleteUserRole(){
        if (isset($_POST["uid"]) && isset($_POST["role"]) && isset($_GET["event_id"]))
            (new Organisation)->deleteUserRole($_POST["uid"],$_POST["role"],$_GET["event_id"]);
        Controller::redirect("/Event/view",["page"=>'userroles',"event_id"=>$_GET["event_id"]]);
    }

               
}

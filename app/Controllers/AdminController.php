<?php
class AdminController{
    public function dashboard(){
        $user_roles = Controller::accessCheck(["admin"]);
        View::render('adminPage',$user_roles);
    }

    public function view(){
        $user_roles = Controller::accessCheck(["admin"]);
        $admin=new Admin();
        if(!isset($_SESSION)) 
            session_start();
        $uid=$_SESSION["user"]["uid"];
        $admin_details=$admin->getDetails($uid); 
        View::render('adminProfile',$admin_details,$user_roles);
    }
    public function updateProfilePic(){
        var_dump($_FILES['profile_pic']);
        $admin=new Admin();
        $uid=$_SESSION["user"]["uid"];
        $data=["uid"=>$uid,"profile_pic"=>$_FILES['profile_pic']];
        $admin->changeProfilePic($data); 

    }

    public function updateUsername(){

        $admin=new Admin();
        $uid=$_SESSION["user"]["uid"];
        $admin->changeUsername($uid,$_POST['username']);
        Controller::redirect("/Admin/view");
        
    }

    public function updateContactNumber(){

        $validate = new Validation();
        $admin = new Admin();
        $uid=$_SESSION["user"]["uid"];
        $data = [ "contact_number"=> $_POST['contact_number']];
        if (!$validate->telephone($_POST["contact_number"])){
            $error["telephoneerr"] = "Valid telephone number required !";
        }   
        if(isset($error)) {

            View::render('adminProfile',$error);
        }          
            
        else
            
            $admin->changeContactNumber($uid,$data);
            Controller::redirect("/Admin/view");
        
    }
    

    public function profile()
    {        
        $user_roles=Controller::accessCheck(["admin"]);
        $admin = new Admin();
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
            Controller::redirect("/Admin/view",$error);
        }
        else
           $admin->changeEmail($uid,$data);
            Controller::redirect("/Admin/view");
        
    }
    public function updatePassword(){
        $admin = new Admin();
        $user = new User();
        $validate =new Validation();
        $uid=$_SESSION["user"]["uid"];
        $data = ["uid"=>$_POST['uid'],"password"=>$_POST['password']];
        if(!$admin->checkCurrentPassword($uid,$_POST['current_password'])){
            $error1=["currentpassworderr"=>"Password incorrect"];
            Controller::redirect("/RegisteredUser/view", $error1);
        }
        if(!$validate->password($_POST["new_password"])) {
            $error2 = ["newpassworderr"=>"Strong password required<br> Combine least 8 of the following: uppercase letters,lowercase letters,numbers and symbols"];
            Controller::redirect("/RegisteredUser/view",$error2);
        }
        else{
            $admin->changePassword($uid,$data);
            Controller::redirect("/RegisteredUser/view");

        }
                
    }
    function checkEmailAvailable(){
        if((new Validation)->email($_POST["email"]));
        echo json_encode(array("taken"=>(new User)->checkUserEmail($_POST["email"])));
    }


    public function activityLog()
    {
        View::render('history');
    }
}

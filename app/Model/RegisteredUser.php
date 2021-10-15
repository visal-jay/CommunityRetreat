<?php



class RegisteredUser extends User
{
    //Function for get user roles(Moderator/Treasurer)
    public function getUserRoles($uid,$event_id){
        $query = 'SELECT  moderator_flag,treasurer_flag FROM moderator_treasurer WHERE uid = :uid AND event_id = :event_id';
        $params = ["uid" => $uid,"event_id"=>$event_id];
        $result=User::select($query,$params);
        $data=array();
        if (count($result)==0)
            return false;
        else{
            if ($result[0]["moderator_flag"])   //If moderator
                array_push($data,"moderator");
            if ($result[0]["treasurer_flag"])   //If treasurer
                array_push($data,"treasurer");
        }
        return $data;
    }

    //Get reg user details
    public function getDetails($uid){
        $query = 'SELECT * FROM registered_user reg JOIN login ON reg.uid= login.uid WHERE reg.uid = :uid AND verified=1';
        $params = ["uid" => $uid];
        $result= User::select($query,$params);
        //var_dump($result);
        if(count($result)==1)   //If data exists
            return $result[0];
        else
            return false;
    }

    // Reg user profile pic change function
    public function changeProfilePic($data){

        if($data['profile_pic']['size']!==NULL){
            $time= (int)shell_exec("date '+%s'"); //Get current time
            // exec("rm -rf /Users/visaljayathilaka/code/group-project/Group-16/app/Uploads/event/cover" . $data["event_id"] . "*");
            $cover_pic = new Image($data['uid'].$time,"profile/","profile_pic",true); //Create Image object 
            $params =["profile_pic"=>  $cover_pic->getURL(),"uid"=>$data['uid']];  //Call getURL function
        }
        $query = 'UPDATE registered_user SET profile_pic= :profile_pic   WHERE uid = :uid ';
        User::insert($query,$params);  

    }
    
    //Username change function
    public function changeUsername($uid,$data){
        $_SESSION["user"]["username"]=$data;
        $params = ["uid" => $uid , "username"=> $data];
        $query = 'UPDATE registered_user SET username= :username   WHERE uid = :uid ' ;
        User::insert($query,$params);       
    }

    //Contact number change function
    public function changeContactNumber($uid,$data){
        
        $params = ["uid" => "$uid" ,"contact_number"=> "$data[contact_number]"];
        $query = 'UPDATE registered_user SET  contact_number = :contact_number  WHERE uid = :uid ' ;
        User::insert($query,$params);   

    }

    //Email change function
    public function changeEmail($uid,$data){
        
        $params = ["uid" => "$uid" ,"email"=> "$data[email]"];
        $query = 'UPDATE registered_user SET  email = :email  WHERE uid = :uid ' ;
        User::insert($query,$params);   
            
    }

    //Password change function
    public function changePassword($uid,$data){
        $params = ["uid" => "$uid" ,"password"=> "$data[password]"];
        $query = 'UPDATE login  JOIN registered_user ON login.uid= registered_user.uid SET login.password =:password where login.uid = :uid and verified=1 ';
        User::insert($query,$params); 
    }


    //Get calendar details
    public function getCalendarDetails($uid){
        $event_details =[];
        $params =["uid"=>"$uid"];
        $query = "SELECT event_id,volunteer_date FROM volunteer WHERE uid = :uid"; //Get event_id's of volunteered events
        $result = Model::select($query,$params);
        $event_details = array();
        for($i=0;$i<count($result);$i++) {

            $event_params = ["event_id" =>  $result[$i]['event_id'],"volunteer_date" => $result[$i]['volunteer_date']];
            $get_event_query = 'SELECT  volunteer.event_id,event_name,organisation_username ,MONTH(volunteer_date) AS month, DAY(volunteer_date) AS day FROM event_details JOIN volunteer  ON event_details.event_id = volunteer.event_id WHERE  volunteer.event_id = :event_id AND volunteer.volunteer_date =:volunteer_date '; //Get event details from event view
            $event_result = Model::select($get_event_query,  $event_params);
            array_push($event_details,$event_result);
        }
        

            return $event_details;


    }
    public function getAdministrations(){
        $administrations = [];
        $params = ["uid" => $_SESSION['user']['uid']];
        $query = 'SELECT event_details.event_id,event_details.event_name,event_details.organisation_username,moderator_treasurer.moderator_flag,moderator_treasurer.treasurer_flag FROM moderator_treasurer JOIN  event_details ON moderator_treasurer.event_id = event_details.event_id WHERE uid =:uid ';
        $administrations = Model::select($query,$params);
        return $administrations;
    }

    public function addRegisteredUser($data){
        $db = Model::getDB();
        $db->beginTransaction();

        $insert_org_ql = 'INSERT INTO `registered_user` (`email`,`username`, `contact_number`) VALUES (:email,  :username, :contact_number)';
        $stmt=$db->prepare($insert_org_ql);
        $insertData=array_intersect_key($data,["email"=>'',"username"=>'',"contact_number"=>'']);
        $stmt->execute($insertData);
        $stmt->closeCursor();
       
        $last_insert_org_sql='SELECT uid FROM registered_user ORDER BY uid DESC LIMIT 1 ';
        $stmt=$db->prepare($last_insert_org_sql);
        $stmt->execute([]);
        $data["uid"] = $stmt->fetchColumn();
        $stmt->closeCursor();

        $data["user_type"]="registered_user";
        $data["password"] = password_hash($data["password"],PASSWORD_DEFAULT);
        $insertOrgLoginSql = 'INSERT INTO `login` (`email`,`password`, `uid`, `user_type`) VALUES (:email,  :password, :uid, "registered_user")';
        $stmt=$db->prepare($insertOrgLoginSql);
        $insertData=array_intersect_key($data,["email"=>'',"password"=>'',"uid"=>'']);
        $stmt->execute($insertData);
        
        $db->commit();

        $encryption=new Encryption;
        $data["time"] = (int)shell_exec("date '+%s'");
        $parameters = ["key" => $encryption->encrypt(["email" => $data["email"], "password" => $data["password"],"time"=>$data["time"]], 'email verificaition')];
        
        $mail=new Mail;

        $mail->verificationEmail($data["email"],"confirmationMail","https://www.communityretreat.me/Signup/verifyemail?".http_build_query($parameters),'Signup');
   
    }
    
}

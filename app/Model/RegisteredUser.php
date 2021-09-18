<?php



class RegisteredUser extends User
{
    public function getUserRoles($uid,$event_id){
        $query = 'SELECT  moderator_flag,treasurer_flag FROM moderator_treasurer WHERE uid = :uid AND event_id = :event_id';
        $params = ["uid" => $uid,"event_id"=>$event_id];
        $result=User::select($query,$params);
        $data=array();
        if (count($data)==0)
            return false;
        else{
            if ($result[0]["moderator_flag"])
                array_push($data,"moderator");
            if ($result[0]["treasurer_flag"])
                array_push($data,"treasurer");
        }
        return $data;
    }
    public function getDetails($uid){
        $query = 'SELECT * FROM registered_user reg JOIN login ON reg.uid= login.uid WHERE reg.uid = :uid AND verified=1';
        $params = ["uid" => $uid];
        $result= User::select($query,$params);
        //var_dump($result);
        if(count($result)==1)
            return $result[0];
        else
            return false;
    }
    
    public function changeUsername($uid,$data){
        $_SESSION["user"]["username"]=$data;
        $params = ["uid" => $uid , "username"=> $data];
        $query = 'UPDATE registered_user SET username= :username   WHERE uid = :uid ' ;
        User::insert($query,$params);       
    }

    public function changeContactNumber($uid,$data){
        
        $params = ["uid" => "$uid" ,"contact_number"=> "$data[contact_number]"];
        $query = 'UPDATE registered_user SET  contact_number = :contact_number  WHERE uid = :uid ' ;
        User::insert($query,$params);   

    }
    public function changeEmail($uid,$data){
        
        $params = ["uid" => "$uid" ,"email"=> "$data[email]"];
        $query = 'UPDATE registered_user SET  email = :email  WHERE uid = :uid ' ;
        User::insert($query,$params);   
            
    }
    public function changePassword($uid,$data){
        $params = ["uid" => "$uid" ,"password"=> "$data[password]"];
        $query = 'UPDATE login  JOIN registered_user ON login.uid= registered_user.uid SET login.password =:password where login.uid = :uid and verified=1 ';
        User::insert($query,$params); 
    }
    function checkCurrentPassword($uid,$password){
        $query= 'SELECT password FROM registered_user reg JOIN login ON reg.uid= login.uid WHERE reg.uid = :uid AND verified=1';
        $params = ["uid"=> $uid];
        $result= USER::select($query,$params);
        if($result[0]['password']==$password){
            return true;
        }
        else{
            return false;
        }
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

        $data["user_type"]="organization";
        $insertOrgLoginSql = 'INSERT INTO `login` (`email`,`password`, `uid`, `user_type`) VALUES (:email,  :password, :uid, "registered_user")';
        $stmt=$db->prepare($insertOrgLoginSql);
        $insertData=array_intersect_key($data,["email"=>'',"password"=>'',"uid"=>'']);
        $stmt->execute($insertData);
        
        $db->commit();

        $encryption=new Encryption;
        $data["time"] = (int)shell_exec("date '+%s'");
        $parameters = ["key" => $encryption->encrypt(array_intersect_key($data, ["email" => '', "password" => '',"time"=>'']), 'email verificaition')];

        $mail=new Mail;
        
        $mail->verificationEmail($data["email"],"confirmationMail","localhost/signup/verifyemail?".http_build_query($parameters),'Signup');
   
    }
    
}

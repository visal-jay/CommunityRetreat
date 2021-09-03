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
        if(count($result[0])>=1)

            return $result[0];
        else
            return false;
    }
    
    public function changeUsername($uid,$data){
        
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
    
}

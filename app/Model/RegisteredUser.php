<?php



class RegisteredUser extends User
{
    public function getUserRoles($uid,$event_id){
        $query = 'SELECT  moderator_flag,treasurer_flag FROM moderator_treasurer WHERE uid = :uid AND event_id =: event_id';
        $params = ["uid" => $uid,"event_id"=>$event_id];
        $result=User::select($query,$params);
        $data=array();
        if ($result[0]["moderator_flag"])
            array_push($data,"moderator");
        if ($result[0]["treasurer_flag"])
            array_push($data,"treasurer");
        
        if (count($data)==0)
            return false;
        else
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
    
    public function update($uid,$data){
        
        if(!$old_data=$this->getDetails($uid))
            return false;
        $params= array_merge($old_data,$data);
        $params["uid"]=$uid;
        unset($params["map"]);
        $query = 'UPDATE registered_user SET username= :username, email= :email, contact_number = :contact_number  ,profile_pic= :profile_pic,city = :city, country=:country  WHERE uid = :uid';
        User::insert($query,$params);       
    }
}

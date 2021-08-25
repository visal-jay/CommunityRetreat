<?php

class RegisteredUser extends User
{
    public function getUserRoles($uid,$event_id){
        $query = 'SELECT  moderator_flag,treasurer_flag FROM moderator_treasurer WHERE uid = :uid AND event_id = :event_id';
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
}

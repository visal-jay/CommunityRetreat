<?php

class Admin extends User{

    public function getDetails($uid){
        $query = 'SELECT * FROM admin adm JOIN login ON adm.uid= login.uid WHERE adm.uid = :uid AND verified=1';
        $params = ["uid" => $uid];
        $result= User::select($query,$params);
        if(count($result[0])>=1)

            return $result[0];
        else
            return false;
    }
    public function changeUsername($uid,$data){
        
        $params = ["uid" => $uid , "username"=> $data];
        $query = 'UPDATE admin SET username= :username   WHERE uid = :uid ' ;
        User::insert($query,$params);       
    }

    public function changeContactNumber($uid,$data){
        
        $params = ["uid" => "$uid" ,"contact_number"=> "$data[contact_number]"];
        $query = 'UPDATE admin SET  contact_number = :contact_number  WHERE uid = :uid ' ;
        User::insert($query,$params);   

    }
    public function changeEmail($uid,$data){
        
        $params = ["uid" => "$uid" ,"email"=> "$data[email]"];
        $query = 'UPDATE admin SET  email = :email  WHERE uid = :uid ' ;
        User::insert($query,$params);   
            
    }
    public function changePassword($uid,$data){
        $params = ["uid" => "$uid" ,"password"=> "$data[password]"];
        $query = 'UPDATE login  JOIN admin ON login.uid= admin.uid SET login.password =:password where login.uid = :uid and verified=1 ';
        User::insert($query,$params); 
    }
    function checkCurrentPassword($uid,$password){
        $query= 'SELECT password FROM admin adm JOIN login ON adm.uid= login.uid WHERE adm.uid = :uid AND verified=1';
        $params = ["uid"=> $uid];
        $result= USER::select($query,$params);
       
        if($result[0]['password']==$password){
            return true;
        }
        else{
            return false;
        }
    }

}
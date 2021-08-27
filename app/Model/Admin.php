<?php

class Admin extends User{

    public function getDetails($uid){
        $query = 'SELECT  admin.username,admin.email,admin.contact_number FROM admin INNER JOIN login ON admin.uid= login.uid WHERE admin.uid = :uid  AND verified=1';
        $params = ["uid" => $uid];
        $result=User::select($query,$params);
        
        if (count($result[0])>1 )
            return $result[0];
        else
            return false;
    }

}
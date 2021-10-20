<?php

class Admin extends User{

    //Get admin details
    public function getDetails($uid){
        $query = 'SELECT * FROM admin adm JOIN login ON adm.uid= login.uid WHERE adm.uid = :uid AND verified=1';
        $params = ["uid" => $uid];
        $result= User::select($query,$params);
        if(count($result[0])>=1) 

            return $result[0];
        else
            return false;
    }

    //Change admin's profile pic 
    public function changeProfilePic($data){

        if($data['profile_pic']['size']!==NULL){
            $time= (int)shell_exec("date '+%s'"); //Get current timestamp
            shell_exec("rm ". __DIR__ ."/../Uploads/profile/" .$data['uid'] ."*");
            $cover_pic = new Image($data['uid']."-".$time,"profile/","profile_pic",true);
            $params =["profile_pic"=>  $cover_pic->getURL(),"uid"=>$data['uid']];  
        }
        $query = 'UPDATE admin SET profile_pic= :profile_pic   WHERE uid = :uid ';
        User::insert($query,$params);  

    }

    //Username change function
    public function changeUsername($uid,$data){
        
        $params = ["uid" => $uid , "username"=> $data];
        $query = 'UPDATE admin SET username= :username   WHERE uid = :uid ' ;
        User::insert($query,$params);       
    }

    //Contact number change function
    public function changeContactNumber($uid,$data){
        
        $params = ["uid" => "$uid" ,"contact_number"=> "$data[contact_number]"];
        $query = 'UPDATE admin SET  contact_number = :contact_number  WHERE uid = :uid ' ;
        User::insert($query,$params);   

    }

    //Email change function
    public function changeEmail($uid,$data){
        
        $params = ["uid" => "$uid" ,"email"=> "$data[email]"];
        $query = 'UPDATE admin SET  email = :email  WHERE uid = :uid ' ;
        User::insert($query,$params);   
            
    }

    //Password change function
    public function changePassword($uid,$data){
        $params = ["uid" => "$uid" ,"password"=> "$data[password]"];
        $query = 'UPDATE login  JOIN admin ON login.uid= admin.uid SET login.password =:password where login.uid = :uid and verified=1 ';
        User::insert($query,$params); 
    }

    public function regUserCount()
    {
        $query = 'SELECT count(uid) as count FROM registered_user';
        $result= Model::select($query);
        return $result[0]["count"];
    }

    public function orgCount()
    {
        $query = 'SELECT count(uid) as count FROM organization';
        $result= Model::select($query);
        return $result[0]["count"];
    }

    public function eventCount()
    {
        $query = 'SELECT count(event_id) as count FROM event WHERE status="published"';
        $result= Model::select($query);
        return $result[0]["count"];
    }

    public function getDonationReport(){/*get the donation sum and date and send it to the graph in view file*/
        $query="SELECT SUM(amount) as donation_sum ,date_format(time_stamp,'%x-%m-%d') as day FROM donation GROUP BY day ORDER BY day ASC";
        $result=Model::select($query);
        if (count($result)==0)
            return false;
        else
            return $result;
    }

    public function getVolunteerReport(){/*get the donation sum and date and send it to the graph in view file*/
        $query="SELECT COUNT(uid) as volunteer_sum ,date_format(date,'%x-%m-%d') as day FROM volunteer GROUP BY day ORDER BY day ASC";
        $result=Model::select($query);
        if (count($result)==0)
            return false;
        else
            return $result;
            
    }

    /*public function eventCount()
    {
        $query = 'SELECT count(uid) FROM event';
        $result= Model::select($query);
        return $result;
    }
*/


}
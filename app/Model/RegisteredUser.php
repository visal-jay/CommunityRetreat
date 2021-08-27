<?php

class RegisteredUser extends User
{
    public function getUserRoles($uid,$event_id){
        $query = 'SELECT  moderator_flag,treasurer_flag FROM moderator_treasurer WHERE uid = :uid AND event_id = :event_id';
        $params = ["uid" => $uid,"event_id"=>$event_id];
        $result=User::select($query,$params);
        var_dump($result);
        $data=array();
        if(count($result)<1)
            return false;
        if ($result[0]["moderator_flag"])
            array_push($data,"moderator");
        if ($result[0]["treasurer_flag"])
            array_push($data,"treasurer");
        
        return $data;
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
        $parameters=["key"=>$encryption->encrypt(array_intersect_key($data,["email"=>'',"password"=>'']),'email verificaition')];

        $mail=new Mail;
        
        $mail->verificationEmail($data["email"],"confirmationMail","localhost/signup/verifyemail?".http_build_query($parameters),'Signup');
   
    }
}

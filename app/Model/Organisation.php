<?php
class Organisation extends User{


    public function addOrganisation ($data)
    {
        $db = Model::getDB();
        $db->beginTransaction();

        $insert_org_ql = 'INSERT INTO `organization` (`email`,`username`, `contact_number`, `account_number`) VALUES (:email,  :username, :contact_number, :account_number)';
        $stmt=$db->prepare($insert_org_ql);
        $insertData=array_intersect_key($data,["email"=>'',"username"=>'',"contact_number"=>'',"account_number"=>'']);
        $stmt->execute($insertData);
        $stmt->closeCursor();

        $last_insert_org_sql='SELECT uid FROM organization ORDER BY uid DESC LIMIT 1 ';
        $stmt=$db->prepare($last_insert_org_sql);
        $stmt->execute([]);
        $data["uid"] = $stmt->fetchColumn();
        $stmt->closeCursor();

        $data["user_type"]="organization";
        $insertOrgLoginSql = 'INSERT INTO `login` (`email`,`password`, `uid`, `user_type`) VALUES (:email,  :password, :uid, :user_type)';
        $stmt=$db->prepare($insertOrgLoginSql);
        $insertData=array_intersect_key($data,["email"=>'',"password"=>'',"uid"=>'',"user_type"=>'']);
        $stmt->execute($insertData);
        
        $db->commit();

        $encryption=new Encryption;
        $parameters=["key"=>$encryption->encrypt(array_intersect_key($data,["email"=>'',"password"=>'']),'email verificaition')];
        
        var_dump($parameters);
        if(class_exists('Mail')){
            echo 'wtf';
        }
        else
            echo 'birch';

        $mail=new Mail;
        echo 'shit';
        if(isset($mail)){
            echo 'dsdas';
            var_dump($mail);
        }
        $mail->verificationEmail($data["email"],"confirmationMail","localhost/signup/verifyemail?".http_build_query($parameters),'Signup');
    }


    public function getDetails($uid){
        $query = 'SELECT  org.username,org.email,org.contact_number,ST_X(org.latlang) as latitude ,ST_Y(org.latlang) as longitude ,org.profile_pic,org.cover_pic,org.about_us FROM organization org INNER JOIN login ON org.uid= login.uid WHERE org.uid = :uid  AND verified=1';
        $params = ["uid" => $uid];
        $result=User::select($query,$params);
        $result[0]["map"]=true;
        if (count($result[0])>=1) {
            if($result[0]["latitude"]==NULL || $result[0]["longitude"]==NULL ){
            $result[0]["map"]=false;
            $result[0]["latitude"]=7.6; 
            $result[0]["longitude"]=7.6;
            }
            return $result[0];
        }
        else
            return false;
    }


    public function updateDetails($uid,$data){
        
        //$data=array_merge(["username"=>'',"email"=>'',"contact_number"=>'',"longitude"=>'',"latitude"=>'',"profile_pic"=>'',"cover_pic"=>'',"about_us"=>''],$data);
        if(!$old_data=$this->getDetails($uid))
            return false;
        $params= array_merge($old_data,$data);
        $params["uid"]=$uid;
        unset($params["map"]);
        $query = 'UPDATE organization SET username= :username, email= :email, contact_number = :contact_number , latlang=POINT(:latitude,:longitude) ,profile_pic= :profile_pic,cover_pic=:cover_pic,about_us=:about_us  WHERE uid = :uid';
        User::insert($query,$params);       
    }
}
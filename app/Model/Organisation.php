<?php
class Organisation extends User{


    public function addOrganisation ($data)
    {
        $db = Model::getDB();
        $db->beginTransaction();

        $insert_org_ql = 'INSERT INTO `organization` (`email`,`username`, `contact_number`) VALUES (:email,  :username, :contact_number)';
        $stmt=$db->prepare($insert_org_ql);
        $insertData=array_intersect_key($data,["email"=>'',"username"=>'',"contact_number"=>'']);
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

        $mail=new Mail;
        
        $mail->verificationEmail($data["email"],"confirmationMail","localhost/signup/verifyemail?".http_build_query($parameters),'Signup');
    }


    public function getDetails($uid){
        $query = 'SELECT  org.username,org.email,org.contact_number,ST_X(org.latlang) as latitude ,ST_Y(org.latlang) as longitude ,org.profile_pic,org.cover_pic,org.about_us FROM organization org INNER JOIN login ON org.uid= login.uid WHERE org.uid = :uid  AND verified=1';
        $params = ["uid" => $uid];
        $result=User::select($query,$params);
        $result[0]["map"]=true;
        
        if (count($result[0])>1 ) {
            if($result[0]["latitude"]==NULL || $result[0]["longitude"]==NULL ){
            $result[0]["map"]=false;
            }
            return $result[0];
        }
        else
            return false;
    }


    public function updateDetails($uid,$data){

        $params= array();
        
        if(isset($_FILES["cover-photo"])){
            $cover_pic = new Image($_SESSION["user"]["uid"],"cover/","cover-photo",true);
            $params["cover_pic"] = $cover_pic->getURL();
        }

        var_dump($params);
        if(isset($_FILES["profile-photo"])){
            $cover_pic = new Image($_SESSION["user"]["uid"],"profile/","profile-photo",true);
            $params["profile_pic"] = $cover_pic->getURL();
        }


        
        foreach (array_keys($data, NULL) as $key) {
            unset($array[$key]);
        }
        if(!$old_data=$this->getDetails($uid))
            return false;

        $params=array_merge(array_merge($old_data,$data),$params);
        $params["uid"]=$uid;
        
        unset($params["map"]);

      
        $query = 'UPDATE organization SET username= :username, email= :email, contact_number = :contact_number , latlang=POINT(:latitude,:longitude) ,profile_pic = :profile_pic,cover_pic = :cover_pic,about_us=:about_us  WHERE uid = :uid';
        User::insert($query,$params);

    }

    public function getEvents($status="deleted"){
        $query = 'SELECT event_name,start_date,volunteer_status,donation_status from event WHERE NOT status="deleted" AND ';
        //$params = ["uid" => $uid];
        //$result=User::select($query,$params);
    }

   

    public function query($args){
        $org_username = NULL;
        extract($args, EXTR_OVERWRITE);

        $query_select_primary = "SELECT uid ";
        $query_table = 'FROM organization WHERE ';
        $query_filter_organization_name = ' username LIKE  "%:org_username%" AND ';
        $query_filter_last = ' 1=1 ';

        $query = $query_select_primary;

        $query = $query . $query_table;

        if ($org_username != NULL) {
            $query = $query . $query_filter_organization_name;
            $params["org_username"] = $org_username;
        }

        $query = $query . $query_filter_last;
      
        $result = Model::select($query, $params);
        
        if(count($result)==0)
            return false;
        return $result;
    }

}
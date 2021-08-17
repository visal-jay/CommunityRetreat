<?php
class Organisation extends Model{

    public function checkUserEmail ($email){
        $query = 'SELECT COUNT(*) as count FROM organization where email = :email ';
        $params = ["email" => "$email"];
        echo $email;
        if((Organisation::select($query,$params))[0]["count"]==1)
            return true;
        else
            return false;
    }

    public function addOrganisation ($data)
    {
        $db = Model::getDB();
        $db->beginTransaction();

        $insertOrgSql = 'INSERT INTO `organization` (`email`,`username`, `contact_number`, `account_number`) VALUES (:email,  :username, :contact_number, :account_number)';
        $stmt=$db->prepare($insertOrgSql);
        $insertData=array_intersect_key($data,["email"=>'',"username"=>'',"contact_number"=>'',"account_number"=>'']);
        $stmt->execute($insertData);
        $stmt->closeCursor();

        $lastInsertOrgSql='SELECT uid FROM organization ORDER BY uid DESC LIMIT 1 ';
        $stmt=$db->prepare($lastInsertOrgSql);
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
        $mail->verificationEmail($data["email"],"/signup/verifyemail?".$query=http_build_query($parameters),'signup');
    }

    public function authenticate($email,$password)
    {
        $query = 'SELECT COUNT(*) as count FROM login where email = :email AND password = :password';
        $params = ["email" => "$email","password"=>"$password"];
        $result=Organisation::select($query,$params);
        if ($result[0]["count"]== 1)
            return true;
        else
            return false;
    }

}
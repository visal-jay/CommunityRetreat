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
        $mail=new Mail;
        $mail->verificationEmail($data["email"],"confirmationMail","localhost/signup/verifyemail?".http_build_query($parameters),'Signup');
    }



}
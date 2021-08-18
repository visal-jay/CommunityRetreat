<?php
class User extends Model
{
    public function checkUserEmail($email)
    {
        $query = 'SELECT COUNT(*) as count FROM login where email = :email ';
        $params = ["email" => $email];
        echo $email;
        if ((User::select($query, $params))[0]["count"] == 1)
            return true;
        else
            return false;
    }

    public function authenticate($email,$password,$verified=1)
    {
        $query = 'SELECT uid,user_type,COUNT(*) as count FROM login where email = :email AND password = :password AND verified= :verified';
        $params = ["email" => $email,"password"=>$password,"verified"=>$verified];
        $result=User::select($query,$params);
        if ($result[0]["count"]== 1)
            return $result[0];
        else
            return false;
    }


    function setVerification($uid){
        $query = 'UPDATE login SET verified=1  WHERE uid = :uid';
        $params = ["uid" => $uid];
        User::insert($query,$params);
    }
}

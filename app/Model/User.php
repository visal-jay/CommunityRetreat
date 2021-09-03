<?php

class User extends Model
{
    public function checkUserEmail($email)
    {
        $query = 'SELECT COUNT(*) as count FROM login where email = :email ';
        $params = ["email" => $email];
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

    public function getForgotPasswordKey ($email){
        $encryption= new Encryption;
        $query = 'SELECT email,password FROM login where email = :email AND verified= 1';
        $params = ["email" => $email];
        $result=User::select($query,$params);
        $time= (int)shell_exec("date '+%s'");
        return $encryption->encrypt(array_merge($result[0],["time"=>$time]),'reset password');
    }

    function setVerification($uid){
        $query = 'UPDATE login SET verified=1  WHERE uid = :uid';
        $params = ["uid" => $uid];
        User::insert($query,$params);
    }

    function getFailedLogin($email){
        $query = 'SELECT UNIX_TIMESTAMP(first_failed_login) as first_failed_login, failed_login_count FROM login WHERE email= :email AND verified = :verified LIMIT 1';
        $params = ["email" => $email,"verified"=>1];
        $result=User::select($query,$params);
        if (count($result[0])> 1)
            return $result[0];
        else
            return false;
    }

    function updateFailedLogin($email,$failed_login_count,$first_failed_login){
        $first_failed_login=date('Y/m/d H:i:s', $first_failed_login);
        $query = 'UPDATE login SET failed_login_count= :failed_login_count ,first_failed_login= :first_failed_login  WHERE email = :email';
        $params = ["email" => $email,"first_failed_login"=>$first_failed_login,"failed_login_count"=>$failed_login_count];
        User::insert($query,$params);
    }

    
    function checkLoginAcess($email){
        $bad_login_limit = 5;
        $lockout_time = 600;
        $query = 'SELECT UNIX_TIMESTAMP(first_failed_login) as first_failed_login, failed_login_count FROM login WHERE email= :email AND verified = :verified LIMIT 1';
        $params = ["email" => $email,"verified"=>1];
        $result=User::select($query,$params);
        var_dump($result);
        if (count($result)>= 1){
            extract($result[0], EXTR_OVERWRITE);
           $time= (int) shell_exec("date '+%s' ");
            if (($failed_login_count >= $bad_login_limit) && ($time - $first_failed_login < $lockout_time))
                return true;
            else
                return false;
        }
        else
            return false;
    }

    function resetPassword($email,$password){
        $query = 'UPDATE login SET password= :password  WHERE email = :email';
        $params = ["email" => $email,"password"=>$password];
        User::insert($query,$params);
    }



}

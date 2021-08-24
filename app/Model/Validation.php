<?php
class Validation
{
    public function email($email = '')
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function telephone($telephone = '')
    {
        return preg_match('/^[+]?[0-9]{10,11}$/', $telephone);
    }

    public function password($password = '')
    {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password);
    }

    public function currency($amount = '')
    {
        return preg_match('/^[0-9]*$/', $amount);
    }

    public function bankaccount($account = '')
    {
        return preg_match('/^[0-9]{8,18}$/', $account);
    }

    public function credtcard($cardnumber = '')
    {
        return preg_match('/^[0-9]{13,16}$/', $cardnumber);
    }
}

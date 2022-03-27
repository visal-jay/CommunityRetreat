<?php


class ErrorHandler
{

    public static function error($error_level,$error_message, $error_file,$error_line,$error_class)
    {  
        echo "<h3>Fatal error </h3>";
        echo "<p>Uncaught exception: '" . $error_class . "'</p>";
        echo "<p>Message: '" . $error_message . "'</p>";
        echo "<p>Thrown in '" . $error_file . "' on line " . $error_line . "</p>";
    }

    public static function exception($exception)
    {
        $code = $exception->getCode();
        if ($code != 404) {
            $code = 500;
        }
        if($code==404){
            $user_roles = Controller::accessCheck(["admin","organization","registered_user","guest_user"]);
            View::render("nav",[],$user_roles);
            View::render("error/error404",[],$user_roles);
            View::render("footer",[],$user_roles);
            return;
        }
        $arr = array('message' => 'blah'); //etc


        echo "####". $exception->getMessage() . "####";
        
        http_response_code($code);
        echo "<h3>Fatal exception $code</h3>";
        echo "<p>Uncaught exception: '" . get_class($exception) . "'</p>";
        echo "<p>Message: '" . $exception->getMessage() . "'</p>";
        echo "<p>Stack trace:<pre>" . $exception->getTraceAsString() . "</pre></p>";
        echo "<p>Thrown in '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";
    }
}
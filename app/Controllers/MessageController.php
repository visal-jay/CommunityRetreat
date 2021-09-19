<?php

class MessageController
{

    public function getMessages()
    {
        echo json_encode((new Message)->getMessages($_SESSION["user"]["uid"], $_POST["uid"]));
    }

    public function getChatList()
    {
        //$_SESSION["user"]["uid"]="REG0000046";
        $message=new Message;
        $results = $message->getChatList($_SESSION["user"]["uid"]);
        //$results = $message->getChatList("REG0000046");
        //var_dump($results);
        //exit();
        $data = array();

        foreach ($results as $result) {
            $result = $result["uid"];
            $user_type = substr($result, 0, 3);
            if ($user_type == "ORG"){
                if ($org = (new Organisation)->getDetails($result))
                    array_push($data, ["username" => $org["username"], "uid" => $result, "photo" => $org["profile_pic"]]);
                $user=$result;
            }
            elseif ($user_type == "REG"){
                if ($reg = (new RegisteredUser)->getDetails($result))
                    array_push($data, ["username" => $reg["username"], "uid" => $result, "photo" => $reg["profile_pic"]]);
                $user=$result;
            }
            elseif ($user_type == "ADM"){
                if ($adm = (new Admin)->getDetails($result))
                    array_push($data, ["username" => $adm["username"], "uid" => $result, "photo" => $adm["profile_pic"]]);
                    $user=$result;
            }
            elseif ($user_type == "EVN"){
                $user=substr($result, 2);
                array_push($data, ["uid" => $result, "username" => ((new Events)->getDetails($user))["event_name"]]);
            }
            if(count($data)>0){
                $data[count($data)-1] = array_merge($data[count($data)-1],($message->getLastMessage($_SESSION["user"]["uid"],$user))[0]);
                //var_dump($data);
            }
        }
        echo json_encode($data);
    }


    public function sendMessage(){
        (new Message)->insertMessage($_SESSION["user"]["uid"],$_POST["reciever"],$_POST["message"]);
    }
}

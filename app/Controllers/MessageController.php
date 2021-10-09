<?php

class MessageController
{

    public function getMessages()
    {
        $user=isset($_GET["event_id"]) ? "EVN" . trim($_GET["event_id"]) : $_SESSION["user"]["uid"];
        echo json_encode((new Message)->getMessages($user, $_POST["uid"]));
    }

    public function getChatList()
    {
        $message=new Message;
        $chat_holder=isset($_GET["event_id"]) ? "EVN" . $_GET["event_id"] : $_SESSION["user"]["uid"];
        $results = $message->getChatList($chat_holder);
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
                $user=substr($result, 3);
                $event_details=(new Events)->getDetails($user);
                array_push($data, ["uid" => $result, "username" => $event_details["event_name"],"photo" => $event_details["cover_photo"]]);
            }
            if(count($data)>0){
                $data[count($data)-1] = array_merge($data[count($data)-1],($message->getLastMessage($chat_holder,$result))[0]);
                //var_dump($data);
            }
        }
        echo json_encode($data);
    }


    public function sendMessage(){
        $user=isset($_GET["event_id"]) ? "EVN" . trim($_GET["event_id"]) : $_SESSION["user"]["uid"];
        (new Message)->insertMessage($user,$_POST["reciever"],$_POST["message"]);
    }

    public function newChat(){
        $data=array();
        $user_type = substr($_GET['new_chat_id'], 0, 3);
        $user=substr($_GET['new_chat_id'], 3);
        if ($user_type == "EVN"){
            $event_details=(new Events)->getDetails($user);
            array_push($data, ["uid" => $_GET['new_chat_id'], "username" => $event_details["event_name"],"photo" => $event_details["cover_photo"]]);
        }
        echo json_encode($data);
    }
}

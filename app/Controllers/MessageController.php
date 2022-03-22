<?php

class MessageController
{

    public function getMessages()
    {
        $user = isset($_GET["event_id"]) ? "EVN" . trim($_GET["event_id"]) : $_SESSION["user"]["uid"]; //user identification
        echo json_encode((new Message)->getMessages($user, $_POST["uid"])); //get messages between user and the other party
    }

    public function getChatList()
    {
        $message = new Message;
        $chat_holder = isset($_GET["event_id"]) ? "EVN" . $_GET["event_id"] : $_SESSION["user"]["uid"]; //determminig the chat holder
        $results = $message->getChatList($chat_holder); //get chat list
        $data = array();

        foreach ($results as $key => $result) {
            $result = $result["uid"];
            $user_type = substr($result, 0, 3);
            //get user name, profile pic, and status of the users
            if ($user_type == "ORG") {
                if ($org = (new Organisation)->getDetails($result))
                    array_push($data, ["username" => $org["username"], "uid" => $result, "photo" => $org["profile_pic"], "status" => true]);
                else
                    array_push($data, ["username" => "Deleted User", "uid" => $result, "photo" => "/Uploads/placeholder-image.jpg", "status" => false]);

                $user = $result;
            } elseif ($user_type == "REG") {
                if ($reg = (new RegisteredUser)->getDetails($result))
                    array_push($data, ["username" => $reg["username"], "uid" => $result, "photo" => $reg["profile_pic"], "status" => true]);
                else
                    array_push($data, ["username" => "Deleted User", "uid" => $result, "photo" => "/Uploads/placeholder-image.jpg", "status" => false]);
                $user = $result;
            } elseif ($user_type == "ADM") {
                if ($adm = (new Admin)->getDetails($result))
                    array_push($data, ["username" => $adm["username"], "uid" => $result, "photo" => $adm["profile_pic"], "status" => true]);
                $user = $result;
            } elseif ($user_type == "EVN") {
                $user = substr($result, 3);
                $event_details = (new Events)->getDetails($user);
                if ($event_details["status"] == "published")
                    array_push($data, ["uid" => $result, "username" => $event_details["event_name"], "photo" => $event_details["cover_photo"], "status" => true]);
                else
                    array_push($data, ["uid" => $result, "username" => $event_details["event_name"], "photo" => $event_details["cover_photo"], "status" => false]);
            }
            //get last message of the recipient
            if (count($data) > 0) {
                $data[count($data) - 1] = array_merge($data[count($data) - 1], ($message->getLastMessage($chat_holder, $result))[0]);
            }
        }
        echo json_encode($data);
    }


    //send messages
    public function sendMessage()
    {
        $user = isset($_GET["event_id"]) ? "EVN" . trim($_GET["event_id"]) : $_SESSION["user"]["uid"];
        (new Message)->insertMessage($user, $_POST["reciever"], $_POST["message"]);
    }

    //new chat
    public function newChat()
    {
        $data = array();
        $user_type = substr($_GET['new_chat_id'], 0, 3);    //user identification
        $user = substr($_GET['new_chat_id'], 3);    //user id
        //new chats are initiliazed only with events 
        if ($user_type == "EVN") {
            $event_details = (new Events)->getDetails($user); //get event details
            array_push($data, ["uid" => $_GET['new_chat_id'], "username" => $event_details["event_name"], "photo" => $event_details["cover_photo"]]);
        }
        echo json_encode($data);
    }
}

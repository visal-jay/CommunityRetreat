<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail
{

    private $mail = NULL;
    function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host       = 'smtp.gmail.com;';
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = 'communityretreatproject@gmail.com';
        $this->mail->Password   = 'community123!';
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port       = 587;
        $this->mail->setFrom('communityretreatproject@gmail.com', 'Commuintyretreat');
        $this->mail->isHTML(true);
    }

    public function sendMail($recievers, $subject, $body)
    {
        foreach ($recievers as $reciever) {
            $this->mail->addAddress($reciever);
            $this->mail->Body    = $body;
        }
        try{
        $this->mail->send();
        }
        catch (Exception $e){
            throw new \Exception("emailed failed", 500);
        }
    }

    public  function verificationEmail($reciever,$url, $subject)
    {
        $recievers=[$reciever];
        $body = "<a href=localhost".$url."> click me</a>";
        $this->sendMail($recievers, $subject, $body);
    }
}

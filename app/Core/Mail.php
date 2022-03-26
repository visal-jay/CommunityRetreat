<?php

require __DIR__ .'/../Libararies/PHPMailer-6.5.0/src/Exception.php';
require __DIR__ .'/../Libararies/PHPMailer-6.5.0/src/PHPMailer.php';
require __DIR__ .'/../Libararies/PHPMailer-6.5.0/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;  

class Mail
{
    private $mail = NULL;

    public function sendMail($recievers, $subject, $body)
    {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Timeout=30;
        $this->mail->SMTPDebug = SMTP::DEBUG_SERVER; 
        $this->mail->Host       = 'smtp.sendgrid.net;';
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = 'apikey';
        $this->mail->Password   = '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';
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port       = 587;
        $this->mail->setFrom('communityretreatproject@gmail.com', 'Commuintyretreat');
        $this->mail->isHTML(true);

        foreach ($recievers as $reciever) {
            //$this->mail->addBCC($reciever);
            $this->mail->addAddress($reciever);
        }
        $this->mail->Body = $body;
        $this->mail->Subject= $subject;
        try {
            $this->mail->send();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public  function verificationEmail($reciever,$body_file,$url, $subject)
    {
        $recievers = [$reciever];    
        $body = View::renderTostring($body_file,["url" => $url]);
        $this->sendMail($recievers, $subject, $body);
    }

    public  function notificationEmail($reciever,$body_file,$data, $subject)
    {
        $recievers = [$reciever];    
        $body = View::renderTostring($body_file,$data);
        $this->sendMail($recievers, $subject, $body);
    }

    public function contactUsEmail($body_file,$data)
    {
        $body = View::renderTostring($body_file,$data);
        $this->sendMail(["communityretreatproject@gmail.com"], "Request to contact", $body);
    }

}

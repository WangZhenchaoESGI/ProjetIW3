<?php

declare(strict_types=1);

namespace Core;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
class Mail{

    private $name;
    private $email;
    private $sujet;
    private $content;

    public function __construct($name, $email, $sujet, $content){
        $this->name = $name;
        $this->email = $email;
        $this->sujet = $sujet;
        $this->content = $content;
    }

    public function sendMail(){

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {

            /*
             * Configuration de PHPMailer => /config/mail.php
             */

            //Server settings
            //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = Host;  // Specify main and backup SMTP servers
            $mail->SMTPAuth = SMTPAuth;                               // Enable SMTP authentication
            $mail->Username = Username;                 // SMTP username
            $mail->Password = Password;                           // SMTP password
            $mail->SMTPSecure = SMTPSecure;                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = Port;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom(Username, TITLE);
            $mail->addAddress($this->email, $this->name);     // Add a recipient

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $this->sujet;
            $mail->Body    = $this->content;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
        } catch (Exception $e) {

            // Log => Error
            $handle = fopen("log_mail.txt", "a+");
            fwrite($handle, $mail->ErrorInfo."\r\n");
            fclose($handle);
        }

    }

}




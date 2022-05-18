<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function send_mail(array $set_from, array $add_address, array $data=array(), $registration = 0, array $add_reply_to = array('email' => 'no-reply@bwajes-plus.andadel.com', 'message' => 'Do not reply to this mail'))
{
    // require('vendor/autoload.php');
    require('vendor/phpmailer/phpmailer/src/PHPMailer.php');
    require('vendor/phpmailer/phpmailer/src/SMTP.php');
    require('vendor/phpmailer/phpmailer/src/Exception.php');

    //sending password to user via email
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'myphptestemail@gmail.com';
        $mail->Password   = '@Deforce9';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom($set_from['email'], $set_from['name']);
        $mail->addAddress($add_address['email'], $add_address['name']);
        $mail->addReplyTo($add_reply_to['email'], $add_reply_to['message']);
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Getting started with bwajes+';
        $mail->Body    = 'Your <b>password</b> is' . $data['password'];
        $mail->AltBody = 'Your password is' . $data['password'];

        if($mail->send())
        {
            if($registration == 1)
            {
                // $msg = "You've successfully registered and your account has been activated. Please login";
                // set_msg($msg);
                // redirect_to('login');
                echo 'successful registration!';
            }
            else
            {
                echo 'Message has been sent!';
            }

        }
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
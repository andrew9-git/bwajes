<?php
use PHPMAILER\PHPMAILER\PHPMAILER;
use PHPMAILER\PHPMAILER\SMTP;
use PHPMAILER\PHPMAILER\EXCEPTION;

require('vendor/autoload.php');

require_once('includes/functions.php');
session_start();

if(isset($_POST['csrf']))
{
    $post_csrf = $_POST['csrf'];
    $first_name = trim($_POST['firstname']);
    $last_name = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $business_name = trim($_POST['businessname']);
    $gender = trim($_POST['gender']);
    $TOS = trim($_POST['TOS']);
    $PRIP = trim($_POST['PRIP']);
    
    //generating password for user
    $password='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_-=+[]{}()@?';
    $password = str_shuffle($password);
    $password = substr($password, 0, 8);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    //error array
    $errors = array();
    
    function first_name_validated()
    {
        global $first_name;

        $message = ucfirst($first_name) . ' is not a valid first name';
        if(has_presence($first_name, $msg = "First name cannot be blank") && accepted_field_length($first_name, 2, 30) && accepted_data_type($first_name, 'str', $message))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function last_name_validated()
    {
        global $last_name;

        $message = ucfirst($last_name) . ' is not a valid last name';
        if(has_presence($last_name, $msg = "Last name cannot be blank") && accepted_field_length($last_name, 2, 30) && accepted_data_type($last_name, 'str', $message))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function email_validated()
    {
        global $email;

        if(has_presence($email, $msg = "Email cannot be blank") && accepted_data_type($email, 'email'))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function business_name_validated()
    {
        global $business_name;

        $message = ucfirst($business_name) . ' is not a valid business name';
        if(has_presence($business_name, $msg = "business name cannot be blank") && accepted_field_length($business_name, 1, 255) && accepted_data_type($business_name, 'str2', $message))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function TOS_validated()
    {
        global $TOS;
        if(is_checked($TOS, 'Terms of Service'))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function PRIP_validated()
    {
        global $PRIP;
        if(is_checked($PRIP, 'Privacy Policy'))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    //validating all fields
    if(csrf_is_valid($_SESSION['csrf'], $post_csrf) && first_name_validated() && last_name_validated() && email_validated() && business_name_validated() && accepted_gender($gender) && TOS_validated() && PRIP_validated())
    {
        //checking if the user already exists
        $user_exists = db_row_count($email, 'email', 'users', 1);
        if($user_exists !== true)
        {
            //insert user into email list table with source of 'u'
            $values = array($first_name, $email, 'u');

            $executed = insert_into_email_list($values);

            if($executed)
            {
                //insert user into users table
                $values = array($first_name, $last_name, $email, $business_name, $gender, $hashed_password);

                $executed = insert_into_users($values);

                if($executed)
                {
                    //sending password to user via email
                    //Create an instance; passing `true` enables exceptions
                    $mail = new PHPMailer(true);

                    try {
                        //Server settings
                        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                        $mail->isSMTP();
                        $mail->Host       = 'smtp.gmail.com';
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'andrewadelodun@gmail.com';
                        $mail->Password   = 'unilagadmissions';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                        $mail->Port       = 465;

                        //Recipients
                        $mail->setFrom('andrewadelodun@gmail.com', 'Andrew');
                        $user_name = $first_name . ' ' . $last_name;
                        $mail->addAddress($email, $user_name);
                        $mail->addReplyTo('no-reply@gmail.com', 'Do not reply to this mail');
                        // $mail->addCC('cc@example.com');
                        // $mail->addBCC('bcc@example.com');

                        //Attachments
                        // $mail->addAttachment('/var/tmp/file.tar.gz');
                        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'Getting started with bwajes+';
                        $mail->Body    = 'Your <b>password</b> is' . $password;
                        $mail->AltBody = 'Your password is' . $password;

                        if($mail->send())
                        {
                            // $msg = "You've successfully registered and your account has been activated. Please login";
                            // set_msg($msg);
                            // redirect_to('login');
                            echo 'successful registration!';
                        }
                        
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                }
            }
        }
    }
    else
    {
        form_errors($errors);
    }

    echo $password.'<br>';
    echo $hashed_password.'<br>';
    if(password_verify($password, $hashed_password))
    {
        echo 'password matches with hash!';
    }

}
?>
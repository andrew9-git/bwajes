<?php

require_once('includes/functions.php');
include('includes/phpmailer.php');
include('includes/email-template.php');
session_start();

//for registration of users
if(isset($_POST['businessname']))
{
    // $post_csrf = $_POST['csrf'];
    $first_name = trim($_POST['firstname']);
    $last_name = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $business_name = trim($_POST['businessname']);
    $gender = trim($_POST['gender']);
    $TOS = trim($_POST['TOS']);
    $PRIP = trim($_POST['PRIP']);
    
    //generating password for user
    $password='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_-=+[]{}()@?&';
    $password = str_shuffle($password);
    $password = substr($password, 0, 8);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    //error array
    $errors = array();

    // if(csrf_is_valid($_SESSION['csrf'], $post_csrf) == false)
    // {
    //     $errors[] = 'Ooops...Something went wrong. Please try again later';
    // }
    if(has_presence($first_name) == false)
    {
        $errors[] = 'First name cannot be empty';
    }
    elseif(strlen($first_name) < 2)
    {
        $name = ucfirst($first_name);
        $errors[] = $name . ' cannot be lesser than 2 characters';
    }
    elseif(strlen($first_name) > 30)
    {
        $name = substr(ucfirst($first_name), 0, 8);
        $errors[] = $name . ' cannot be more than 30 characters';
    }
    
    elseif(accepted_data_type($first_name, 'str') == false)
    {
        $name = ucfirst($first_name);
        $errors[] = $name . ' is not a valid first name';
    }
    if(has_presence($last_name) == false)
    {
        $errors[] = 'Last name cannot be empty';
    }
    elseif(strlen($last_name) < 2)
    {
        $name = ucfirst($last_name);
        $errors[] = $name . ' cannot be lesser than 2 characters';
    }
    elseif(strlen($last_name) > 30)
    {
        $name = substr(ucfirst($last_name), 0, 8);
        $errors[] = $name . ' cannot be more than 30 characters';
    }
    elseif(accepted_data_type($last_name, 'str') == false)
    {
        $name = ucfirst($last_name);
        $errors[] = $name . ' is not a valid last name';
    }
    if(has_presence($email) == false)
    {
        $errors[] = 'Email cannot be empty';
    }
    elseif(accepted_data_type($email, 'email') == false)
    {
        $errors[] = $email . ' is not a valid email';
    }
    if(has_presence($business_name) == false)
    {
        $errors[] = 'Business name cannot be empty';
    }
    elseif(strlen($business_name) < 1)
    {
        $name = ucfirst($business_name);
        $errors[] = $name . ' cannot be lesser than 1 characters';
    }
    elseif(strlen($business_name) > 255)
    {
        $name = substr(ucfirst($business_name), 0, 8);
        $errors[] = $name . ' cannot be more than 255 characters';
    }
    elseif(accepted_data_type($business_name, 'str2') == false)
    {
        $name = ucfirst($business_name);
        $errors[] = $name . ' is not a valid business name';
    }
    if(accepted_gender($gender) == false)
    {
        $errors[] = 'Please select a gender';
    }
    if(is_checked($TOS) == false)
    {
        $errors[] = 'You have to accept the Terms of Service';
    }
    if(is_checked($PRIP) == false)
    {
        $errors[] = 'You have to accept the Privacy Policy';
    }
    if(empty($errors))
    {
        //checking if the user already exists
        $count = db_row_count($email, 'email', 'users');
        if($count > 0)
        {
            $errors[] =  'This account already exists. Please login';
        }
        else
        {
            //insert user into email list table with source of 1
            $values = array($first_name, $email, 1);

            $executed = insert_into_email_list($values);

            if($executed)
            {
                //insert user into users table
                $values = array($first_name, $last_name, $email, $business_name, $gender, $hashed_password);

                $executed = insert_into_users($values);

                if($executed)
                {
                    $set_from = array(
                        'email' => 'developer@andadel.com',
                        'name' => 'bwajes+'
                    );

                    $name = $first_name. ' ' . $last_name;
                    $add_address = array(
                        'email' => $email,
                        'name' => $name
                    );

                    $subject = 'Getting started with bwajes+';
                    $body_msg = 'Your <b>password</b> is ' . $password;
                    $altbody = 'Your password is' . $password;
                    $body = email_template($body_msg, 0);

                    $data = array(
                        'subject' => $subject,
                        'body' => $body,
                        'altbody' => $altbody,
                        'password' => $password
                    );

                    $mail_response = send_mail($set_from, $add_address, $data);
                    if($mail_response !== true)
                    {
                        echo "<div class='card error'><div>" . $mail_response . "</div></div>";
                    }
                    else
                    {
                        $msg = "<div class='card success'><div>You've successfully registered and your account has been activated. Please check your email for your password and proceed to login</div></div>";
                        echo $msg;
                    }
                }
                else
                {
                    $errors[] = 'Ooops. Something went wrong. Please try again later';
                }
                if(!empty($errors))
                {
                    echo form_errors($errors);
                }
            }
            else
            {
                $errors[] = 'Ooops. Something went wrong. Please try again later';
            }
            if(!empty($errors))
            {
                echo form_errors($errors);
            }
        }
        if(!empty($errors))
        {
            echo form_errors($errors);
        }
    }
    else
    {
        echo form_errors($errors);
    }
    

}

//to log in users to the app
if(isset($_POST['csrf']))
{
    $post_csrf = $_POST['csrf'];
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $remember_me = trim($_POST['remember_me']);

    //error array
    $errors = array();

    if(csrf_is_valid($_SESSION['csrf'], $post_csrf) == false)
    {
        $errors[] = 'Ooops...Something went wrong. Please try again later';
    }

    if(has_presence($email) == false)
    {
        $errors[] = 'Email cannot be empty';
    }
    elseif(accepted_data_type($email, 'email') == false)
    {
        $errors[] = $email . ' is not a valid email';
    }

    if(has_presence($password) == false)
    {
        $errors[] = 'password cannot be empty';
    }
    elseif(accepted_data_type($password, 'password') == false)
    {
        $errors[] = $password . ' is not a valid password';
    }

    if(empty($errors))
    {
        //checking if the user already exists
        $count = db_row_count($email, 'email', 'users');
        if($count > 0)
        {
            //verifying password
            $db_row = fetch_single_row($email, 'email', 'users');
            $db_password = $db_row['password'];
            if(password_verify($password, $db_password) == true)
            {
                //cookie remember me function implementation
                $cookie_exp_time = time() + 10 * 365 * 24 * 60 * 60;
                remember_me($remember_me, $email, $password, $cookie_exp_time);

                $id = $db_row['id'];
                $firstname = $db_row['first_name'];
                $lastname = $db_row['last_name'];
                $user_email = $db_row['email'];
                $time = time();

                $_SESSION['user_data'] = array(
                    'id' => $id,
                    'first_name' => $firstname,
                    'first_name' => $firstname,
                    'email' => $user_email,
                    'time' => $time
                );

                $_SESSION['is_user_logged_in'] = true;

                //update user table by setting active to 1
                $executed = set_active_to_1($id);

                if($executed)
                {
                    //update or insert into user statistics table
                    $count = db_row_count($id, 'user_id', 'user_statistics', 'int');
                    if($count > 0)
                    {
                        //update user statistics table
                        $last_login = date('Y-m-d H:i:s', $time);
                        $browser = get_user_browser();
                        $os = get_user_os();
                        $device_name = get_user_device_name();
                        $values = array(
                            'user_id' => $id,
                            'browser' => $browser,
                            'os' => $os,
                            'device_name' => $device_name
                        );
                        $executed = update_user_statistics($values);
                        if($executed)
                        {
                            echo 'Success!';
                        }
                        else
                        {
                            $msg = "<div class='card error'><div>There was an error</div></div>";
                            echo $msg;
                        }
                    }
                    else
                    {
                        //insert into user statistics table
                        $last_login = date('Y-m-d H:i:s', $time);
                        $browser = get_user_browser();
                        $os = get_user_os();
                        $device_name = get_user_device_name();
                        $values = array($id, $last_login, NULL, $browser, $os, $device_name);
                        $executed = insert_into_user_statistics($values);
    
                        if($executed)
                        {
                            echo 'Success!';
                        }
                        else
                        {
                            $msg = "<div class='card error'><div>There was an error</div></div>";
                            echo $msg;
                        }
                    }
                }

            }
            else
            {
                $msg = "<div class='card error'><div>The password provided is not correct</div></div>";
                echo $msg;
            }
        }
        else
        {
            $msg = "<div class='card error'><div>This account does not exists. Please create an account</div></div>";
            echo $msg;
        }
    }
    else
    {
        echo form_errors($errors);
    }
}

//forgot password script
if(isset($_POST['forgot_password_email']))
{
    //error array
    $errors = array();

    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = 'http://localhost:9090/bwajes/reset-password/' . $selector . '/' . bin2hex($token);

    $expires = time() + 900;

    $email = trim($_POST['forgot_password_email']);

    if(has_presence($email) == false)
    {
        $errors[] = 'Email cannot be empty';
    }
    elseif(accepted_data_type($email, 'email') == false)
    {
        $errors[] = $email . ' is not a valid email';
    }

    if(empty($errors))
    {
        //check if there is a user with the email provided
        $count = db_row_count($email, 'email', 'users');

        if($count > 0)
        {
            //check if the user has a token in forgot password table
            $count = db_row_count($email, 'email', 'forgot_password');

            if($count > 0)
            {

                //delete the entry with the email from forgot_password table
                $executed = delete_single_row($email, 'email', 'forgot_password');
    
                if($executed)
                {
                    //insert into forgot password table
                    $hashed_token = password_hash($token, PASSWORD_DEFAULT);
                    $format_expires = date('Y-m-d H:i:s', $expires);
                    $values = array(
                        'email' => $email,
                        'selector' => $selector,
                        'token' => $hashed_token,
                        'expires' => $format_expires
                    );

                    $executed = insert_into_forgot_password($values);

                    if($executed)
                    {
                        //send reset-password link to user's email
                        $set_from = array(
                            'email' => 'developer@andadel.com',
                            'name' => 'bwajes+'
                        );
    
                        $add_address = array(
                            'email' => $email,
                            'name' => ''
                        );
    
                        $subject = 'Reset your password';
                        $body_msg = '<p>We recieved a password reset request. The link to reset your password is below. If you did not make this request, you can ignore this email</p>
                        <p>Here is your password request link: <br><a href="' .$url . '">' . $url . '</a></p>';
                        $altbody = 'We recieved a password reset request. The link to reset your password is below. If you did not make this request, you can ignore this email\r\n Copy this password request link: \r\n ' .$url . ' \r\nand paste it inside your browser';
                        $body = email_template($body_msg, 0);
    
                        $data = array(
                            'subject' => $subject,
                            'body' => $body,
                            'altbody' => $altbody
                        );
    
                        $mail_response = send_mail($set_from, $add_address, $data);
                        if($mail_response !== true)
                        {
                            echo "<div class='card error'><div>" . $mail_response . "</div></div>";
                        }
                        else
                        {
                            $msg = "<div class='card success'><div>Your request has been recieved. Please check your email</div></div>";
                            echo $msg;
                        }
                    }
                    else
                    {
                        $msg = "<div class='card error'><div>There was an error</div></div>";
                        echo $msg;  
                    }


                }
                else
                {
                    $msg = "<div class='card error'><div>There was an error</div></div>";
                    echo $msg;
                }
            }
            else
            {
                //insert into forgot password table
                $hashed_token = password_hash($token, PASSWORD_DEFAULT);
                $format_expires = date('Y-m-d H:i:s', $expires);
                $values = array(
                    'email' => $email,
                    'selector' => $selector,
                    'token' => $hashed_token,
                    'expires' => $format_expires
                );

                $executed = insert_into_forgot_password($values);

                if($executed)
                {
                    //send reset-password link to user's email
                    $set_from = array(
                        'email' => 'developer@andadel.com',
                        'name' => 'bwajes+'
                    );

                    $add_address = array(
                        'email' => $email,
                        'name' => ''
                    );

                    $subject = 'Reset your password';
                    $body_msg = '<p>We recieved a password reset request. The link to reset your password is below. If you did not make this request, you can ignore this email</p>
                    <p>Here is your password request link: <br><a href="' .$url . '">' . $url . '</a></p>';
                    $altbody = 'We recieved a password reset request. The link to reset your password is below. If you did not make this request, you can ignore this email\r\n Copy this password request link: \r\n ' .$url . ' \r\nand paste it inside your browser';
                    $body = email_template($body_msg, 0);

                    $data = array(
                        'subject' => $subject,
                        'body' => $body,
                        'altbody' => $altbody
                    );

                    $mail_response = send_mail($set_from, $add_address, $data);
                    if($mail_response !== true)
                    {
                        echo "<div class='card error'><div>" . $mail_response . "</div></div>";
                    }
                    else
                    {
                        $msg = "<div class='card success'><div>Your request has been recieved. Please check your email</div></div>";
                        echo $msg;
                    }
                }
                else
                {
                    $msg = "<div class='card error'><div>There was an error</div></div>";
                    echo $msg;  
                }
            }



        }
        else
        {
            $msg = "<div class='card error'><div>This account does not exists. Please check your email and try again</div></div>";
            echo $msg;
        }
    }
    else
    {
        echo form_errors($errors);
    }
}

//reset password script
if(isset($_POST['selector']))
{

    //error array
    $errors = array();

    $selector = trim($_POST['selector']);
    $validator = trim($_POST['validator']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm-password']);

    if(has_presence($password) == false)
    {
        $errors[] = 'The password field cannot be empty';
    }
    elseif(strlen($password) < 8)
    {
        $errors[] = 'The password field cannot be lesser than 8 characters';
    }
    elseif(strlen($password) > 32)
    {
        $name = substr($password, 0, 8);
        $errors[] = 'The password field cannot be more than 32 characters';
    }
    elseif(accepted_data_type($password, 'password') == false)
    {
        $errors[] = 'The password provided is not valid';
    }

    if(has_presence($confirm_password) == false)
    {
        $errors[] = 'The confirm password field cannot be empty';
    }
    elseif(strlen($confirm_password) < 8)
    {
        $errors[] = 'The confirm password field cannot be lesser than 8 characters';
    }
    elseif(strlen($confirm_password) > 32)
    {
        $name = substr($confirm_password, 0, 8);
        $errors[] = 'The confirm password field cannot be more than 32 characters';
    }
    elseif(accepted_data_type($confirm_password, 'password') == false)
    {
        $errors[] = 'The password provided in the confirm password field is not valid';
    }

    if(($password !== $confirm_password) && (has_presence($confirm_password) && has_presence($password)))
    {
        $errors[] = 'The passwords provided does not match!';
    }

    if(empty($errors))
    {

        $current_time = time();
        $format_current_time = date('Y-m-d H:i:s', $current_time);

        $values = array(
            'selector' => $selector,
            'current_time' => $current_time
        );

        $row = fetch_forgot_password($values);

        if($row)
        {
            $token_bin = hex2bin($validator);
            $db_token = $row['token'];
            $token_check = password_verify($token_bin, $db_token);

            if($token_check)
            {
                $email = $row['email'];

                //checking if the user already exists
                $count = db_row_count($email, 'email', 'users');
                if($count > 0)
                {
                    //update user's password
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    $values = array(
                        'email' => $email,
                        'password' => $hashed_password
                    );
                    $executed = update_user_password($values);

                    if($executed)
                    {
                        //delete user from forgot password table
                        $executed = delete_single_row($email, 'email', 'forgot_password');
    
                        if($executed)
                        {
                            echo 'Success!';
                            //sucess message in session that will be displayed in login page
                            $msg = 'Your password has been reset. Please login';
                            set_msg($msg);
                        }
                        else
                        {
                            $msg = "<div class='card error'><div>There was an error</div></div>";
                            echo $msg;
                        }
                    }
                    else
                    {
                        $msg = "<div class='card error'><div>There was an error</div></div>";
                        echo $msg;
                    }
                }
                else
                {
                    $msg = "<div class='card error'><div>There was an error</div></div>";
                    echo $msg;
                }

            }
            else
            {
                $msg = "<div class='card error'><div>There was an error</div></div>";
                echo $msg;
            }
        }
        else
        {
            $msg = "<div class='card error'><div>There was an error</div></div>";
            echo $msg;
        }
    }
    else
    {
        echo form_errors($errors);
    }
}
?>
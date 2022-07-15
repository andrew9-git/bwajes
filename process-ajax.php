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
                    $body_msg = 'Your <b>password</b> is' . $password;
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
        $name = ucfirst($email);
        $errors[] = $name . ' is not a valid email';
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
                $db = new dbase('bwajes+');
                $query = "UPDATE users SET active = :active WHERE id = :id";
                $db->prep($query);

                $db->bindvalue(':id', $id, 'int');
                $db->bindvalue(':active', 1, 'int');

                $executed = $db->execute();

                if($executed)
                {
                    //update or insert into user statistics table
                    $count = db_row_count($id, 'user_id', 'user_statistics', 'int');
                    if($count > 0)
                    {
                        //update user statistics table
                        $last_login = date('Y-m-d H:i:s', $time);
                        $values = array(
                            'user_id' => $id,
                            'browser' => '',
                            'os' => '',
                            'device_name' => ''
                        );
                        $executed = update_user_statistics($values);
                        if($executed)
                        {
                            echo 'Success!';
                        }
                    }
                    else
                    {
                        //insert into user statistics table
                        $last_login = date('Y-m-d H:i:s', $time);
                        $values = array($id, $last_login, '', '', '', '');
                        $executed = insert_into_user_statistics($values);
    
                        if($executed)
                        {
                            echo 'Success!';
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
?>
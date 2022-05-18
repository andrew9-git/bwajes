<?php

require_once('includes/functions.php');
include('includes/phpmailer.php');
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
        $count = db_row_count($email, 'email', 'users');
        if($count <= 0)
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
                    $set_from = array(
                        'email' => 'support@bwajes-plus.andadel.com',
                        'name' => 'bwajes+'
                    );

                    $name = $first_name. ' ' . $last_name;
                    $add_address = array(
                        'email' => $email,
                        'name' => $name
                    );

                    $data = array(
                        'password' => $password
                    );

                    send_mail($set_from, $add_address, $data, 1);
                }
                else
                {
                    echo '<div class="card error">Ooops...Something went wrong. Please try again later';
                }
            }
            else
            {
                echo '<div class="card error">Ooops...Something went wrong. Please try again later';
            }
        }
        else
        {
            echo '<div class="card error">This account already exists. Please login';
        }
    }
    else
    {
        form_errors($errors);
    }

}
?>
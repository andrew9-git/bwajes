<?php

// Database instantiation
require_once('db.php');

function db($dbname='bwajes+')
{
    $db = new dbase($dbname);
    return $db;
}
// End database instantiation

// Miscellenious functions
function url()
{
    $host='http://localhost:9090/bwajes/';
    $host1 = 'http://localhost:9090/andadel/';
    return array($host, $host1);
}

function redirect_to($url)
{
    header("Location: {$url}");
}

function set_msg($msg)
{
    if($msg !== "")
    {
        $_SESSION['setmsg'] = $msg;
    }
}

function display_msg()
{
    if(isset($_SESSION['setmsg']))
    {
        echo '<div class="card success"><div class="card-header"></div><div class="card-body">' . $_SESSION['setmsg'] . '</div></div>';
        $_SESSION['setmsg'] = null;
    }
}

function csrf_token()
{
    //create a key for hash_hmac function
	if (empty($_SESSION['key']))
    $_SESSION['key'] = bin2hex(random_bytes(32));

    //create CSRF token
    $csrf = hash_hmac('sha256', 'this is some string: index.php', $_SESSION['key']);
    return $csrf;
}
// End miscellenious functions

// Form validation functions

//presence
function has_presence($value)
{
    
    // $value = trim($value);
    if(!isset($value) || $value === "")
    {
       return false;
    }
    else
    {
        return true;
    }
}

//string length
function accepted_field_length($value, $min, $max)
{
    
    if(strlen($value) < $min  && strlen($value) > $max)
    {
        return false; 
    }
    else
    {
        return true;
    }
}

//type
function accepted_data_type($value, $field_type)
{
    

    switch($field_type)
    {
        case 'int': 
            if(!filter_var($value, FILTER_VALIDATE_INT))
            {
                return false;  
            }
            else
            {
                return true;
            }
        break;
        case 'email':
            if(!filter_var($value, FILTER_VALIDATE_EMAIL))
            {
                return false;  
            }
            else
            {
                return true;
            }
        break;
        case 'url': 
            if(!filter_var($value, FILTER_VALIDATE_URL))
            {
                return false;  
            }
            else
            {
                return true;
            }
        break;
        case 'str': 
            if(preg_match('/[^A-Za-z\-]/', $value))
            {
                return false; 
            }
            else
            {
                return true;
            }
        break;
        case 'str1': 
            if(preg_match('/[^A-Za-z0-9\-_ ]/', $value))
            {
                return false; 
            }
            else
            {
                return true;
            }
        break;
        case 'str2': 
            if(preg_match('/[^A-Za-z0-9&\?\|\[\]\(\)\{\}\-_ ]/', $value))
            {
                return false;
            }
            else
            {
                return true;
            }
        break;
        case 'password': 
            if(preg_match('/[^A-Za-z0-9&@\?\[\]\(\)\{\}\-_=\+]/', $value))
            {
                return false;
            }
            else
            {
                return true;
            }
        break;
        default: return false;
        break;
    }
}
//inclusion in a set
function found_in($value, array $set, $msg='This is file type is not valid')
{
    
    if(!in_array($value, $set))
    {
        return false;  
    }
    else
    {
        return true;
    }
}

//format
function matches_format($regex, $value)
{
    
    if(!preg_match($regex, $value))
    {
        return false;  
    }
    else
    {
        return true;
    }
}

//validate gender field
function accepted_gender($gender)
{
    
    if($gender === 'S')
    {
        return false;  
    }
    else
    {
        return true;
    }
}

//validate checkbox field
function is_checked($value)
{
    
    if(empty($value))
    {
        return false; 
    }
    else
    {
        return true;
    }
}

//validate token
function csrf_is_valid($session_csrf, $post_csrf)
{
    
    if (hash_equals($_SESSION['csrf'], $post_csrf) === false)
    {
        return false;
    }
    else
    {
        return true;
    }

}

//form error
function form_errors(array $errors)
{
    $output = "";
    if(!empty($errors))
    {
        $output .= "<div class='card error'>";
        $output .= "<div>";
        $output .= "<ul>";
        foreach($errors as $key => $error)
        {
            $output .= "<li>{$error}</li>";
        }
        $output .= "</ul>";
        $output .= "</div>";
        $output .= "</div>";
    }
    return $output;
}

// End form validation functions

//creating a remember me algorithm cookie
function remember_me($value, $email, $password, $exp_time)
{

    if($value == 1)
    {
        setcookie('user_email', $email, $exp_time);
        setcookie('user_password', $password, $exp_time);
    }
    else
    {
        if(isset($_COOKIE['user_email']))
        {
            setcookie('user_email', null, time() - 3600);
        }
        if(isset($_COOKIE['user_password']))
        {
            setcookie('user_password', null, time() - 3600);
        }
    }

}

// Database queries

//uniqueness and row count
function db_row_count($value, $column_name, $table_name, $type='str', $dbname='bwajes+')
{
    // 

    $db = new dbase($dbname);

    $query = "SELECT COUNT(*) FROM $table_name WHERE $column_name = :value";
    $db->prep($query);
    $db->bindvalue(':value', $value, $type);
    $count = $db->fetchCol();
    return $count;
}

//inserting values into email list table

function insert_into_email_list(array $values, $dbname='bwajes+')
{
    

    $db = new dbase($dbname);

    $query = "INSERT INTO email_list(first_name, email, source) VALUES(:first_name, :email, :source)";

    $db->prep($query);

    $db->bindvalue(':first_name', $values[0], 'str');
    $db->bindvalue(':email', $values[1], 'str');
    $db->bindvalue(':source', $values[2], 'str');

    $execute = $db->execute();

    return $execute;
}

//inserting values into users table

function insert_into_users(array $value, $dbname='bwajes+')
{
    

    $db = new dbase($dbname);

    $query = "INSERT INTO users(first_name, last_name, email, business_name, gender, password) VALUES(:first_name, :last_name, :email, :business_name, :gender, :password)";
    $db->prep($query);

    $db->bindvalue(':first_name', $value[0], 'str');
    $db->bindvalue(':last_name', $value[1], 'str');
    $db->bindvalue(':email', $value[2], 'str');
    $db->bindvalue(':business_name', $value[3], 'str');
    $db->bindvalue(':gender', $value[4], 'str');
    $db->bindvalue(':password', $value[5], 'str');

    $execute = $db->execute();

    return $execute;
}

//getting a single row in a table
function fetch_single_row($value, $column_name = 'id', $table_name, $type='str', $dbname='bwajes+')
{
    // 

    $db = new dbase($dbname);

    $query = "SELECT * FROM $table_name WHERE $column_name = :value";
    $db->prep($query);
    $db->bindvalue(':value', $value, $type);
    $row = $db->fetchSingle();
    return $row;
}

//update user statistics table

function update_user_statistics(array $value, $level=1,  $dbname='bwajes+')
{
    

    $db = new dbase($dbname);

    $query = "";
    $query .= "UPDATE user_statistics SET";
    if($level = 1)
    {
        $query .= " last_login = NOW(),";
    }
    elseif($level = 2)
    {
        $query .= " last_logout = NOW(),";
    }
    else
    {
        $query .= " last_login = NOW(),";
        $query .= " last_logout = NOW(),";
    }
    $query .= " browser = :browser, os = :os, device_name = :device_name, updated_at = NOW() WHERE user_id = :user_id";
    $db->prep($query);

    $db->bindvalue(':user_id', $value['user_id'], 'int');
    $db->bindvalue(':browser', $value['browser'], 'str');
    $db->bindvalue(':os', $value['os'], 'str');
    $db->bindvalue(':device_name', $value['device_name'], 'str');

    $execute = $db->execute();

    return $execute;
}

//insert into user statistics table

function insert_into_user_statistics(array $value, $dbname='bwajes+')
{
    

    $db = new dbase($dbname);

    $query = "INSERT INTO user_statistics(user_id, last_login, last_logout, browser, os, device_name) VALUES(:user_id, :last_login, :last_logout, :browser, :os,:device_name)";
    $db->prep($query);

    $db->bindvalue(':user_id', $value[0], 'int');
    $db->bindvalue(':last_login', $value[1], 'str');
    $db->bindvalue(':last_logout', $value[2], 'str');
    $db->bindvalue(':browser', $value[3], 'str');
    $db->bindvalue(':os', $value[4], 'str');
    $db->bindvalue(':device_name', $value[5], 'str');

    $execute = $db->execute();

    return $execute;
}

// End database queries


?>
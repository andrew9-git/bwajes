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
function is_checked($value, $checkbox_name)
{
    
    if($value == 0)
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

// Database queries

//uniqueness and row count
function db_row_count($value, $column_name, $table_name, $dbname='bwajes+', $type='str')
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

    if($execute)
    {
        return true;
    }
    else
    {
        return false;
    }


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

    if($execute)
    {
        return true;
    }
    else
    {
        return false;
    }
}

// End database queries


?>
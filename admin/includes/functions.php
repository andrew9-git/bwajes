<?php

// Database instantiation
require_once('includes/db.php');

function db($dbname)
{
    $db = new dbase($dbname);
    return $db;
}
// End database instantiation

// Miscellenious functions
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

//error array
$error = array();

//presence
function has_presence($value, $msg = "No value provided")
{
    // $value = trim($value);
    if(!isset($value) || $value === "")
    {
       $errors[] = $msg; 
    }
    else
    {
        return true;
    }
}

//string length
function accepted_field_length($value, $min, $max)
{
    if(strlen($value) < $min)
    {
        $errors[] = 'The characters should not be less than' . $min;
    }
    elseif(strlen($value) > $max)
    {
        $errors[] = 'The characters should not be greater than' . $max;
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
                $errors[] = 'Only numbers are allowed'; 
            }
            else
            {
                return true;
            }
        break;
        case 'email':
            if(!filter_var($value, FILTER_VALIDATE_EMAIL))
            {
                $errors[] = 'The email provided is not valid'; 
            }
            else
            {
                return true;
            }
        break;
        case 'url': 
            if(!filter_var($value, FILTER_VALIDATE_URL))
            {
                $errors[] = $value . 'is not a valid url'; 
            }
            else
            {
                return true;
            }
        break;
        case 'str': 
            if(preg_match('/[^A-Za-Z0-9\-_ ]/', $value))
            {
                $errors[] = $value . 'is not a valid character'; 
            }
            else
            {
                return true;
            }
        break;
    }
}
//inclusion in a set
function found_in($value, array $set)
{
    if(!in_array($value, $set))
    {
        $errors[] = 'This is file type is not valid'; 
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
        $errors[] = 'A match was not found'; 
    }
    else
    {
        return true;
    }
}

//validate token
function csrf_is_valid($csrf)
{
    if (hash_equals($csrf, $_POST['csrf']) === false)
    {
        $errors[] = 'Oops something went wrong. Please try again later';
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
        $output .= "<div class=\"card error\">";
        $output .= "<div class=\"card-header\">";
        $output .= "Please fix the folllowing errors";
        $output .= "</div>";
        $output .= "<div class=\"card-body\">";
        $output .= "<ul>";
        foreach($errors as $key => $error)
        {
            $output .= "<li>{$error}</li>";
        }
        $output .= "</ul>";
        $output .= "</div>";
        $output .= "</div>";
    }
    echo $output;
    $output = null;
}

// End form validation functions

// Database queries

//uniqueness
function db_row_count($value, $column_name, $table_name, $dbname)
{
    $db = db($dbname);

    $query = "SELECT COUNT(*) FROM $table_name WHERE $column_name = $value";
    $db->prep($query);
    $count = $db->fetchCol();

    return $count;
}

// End database queries


?>
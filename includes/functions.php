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
    $host2 = 'http://localhost:9090/bwajesplus-app/';
    return array($host, $host1, $host2);
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
        echo '<div class="card success"><div>' . $_SESSION['setmsg'] . '</div></div>';
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

//checking if the user has already logged in or not
function user_is_logged_in()
{
    if(isset($_SESSION['is_user_logged_in']))
    {
        return true;
    }
    return false;
}

function get_user_browser()
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

	$browser        = "Unknown";
	$browser_array  = array(
		'/msie/i'       =>  'Internet Explorer',
		'/firefox/i'    =>  'Firefox',
		'/safari/i'     =>  'Safari',
		'/chrome/i'     =>  'Chrome',
		'/edge/i'       =>  'Edge',
		'/opera/i'      =>  'Opera',
		'/netscape/i'   =>  'Netscape',
		'/maxthon/i'    =>  'Maxthon',
		'/konqueror/i'  =>  'Konqueror',
		'/mobile/i'     =>  'Handheld Browser'
	);

	foreach ( $browser_array as $regex => $value ) { 
		if ( preg_match( $regex, $user_agent ) ) {
			$browser = $value;
		}
	}
	return $browser;    
}

function get_user_os()
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

	$os_platform =   "Unknown";
	$os_array =   array(
        '/windows nt 11/i'      =>  'Windows 11',
		'/windows nt 10/i'      =>  'Windows 10',
		'/windows nt 6.3/i'     =>  'Windows 8.1',
		'/windows nt 6.2/i'     =>  'Windows 8',
		'/windows nt 6.1/i'     =>  'Windows 7',
		'/windows nt 6.0/i'     =>  'Windows Vista',
		'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
		'/windows nt 5.1/i'     =>  'Windows XP',
		'/windows xp/i'         =>  'Windows XP',
		'/windows nt 5.0/i'     =>  'Windows 2000',
		'/windows me/i'         =>  'Windows ME',
		'/win98/i'              =>  'Windows 98',
		'/win95/i'              =>  'Windows 95',
		'/win16/i'              =>  'Windows 3.11',
		'/macintosh|mac os x/i' =>  'Mac OS X',
		'/mac_powerpc/i'        =>  'Mac OS 9',
		'/linux/i'              =>  'Linux',
		'/ubuntu/i'             =>  'Ubuntu',
		'/ios/i'                =>  'IPhone',
		'/android/i'            =>  'Android',
		'/blackberry/i'         =>  'BlackBerry',
		'/webos/i'              =>  'Mobile'
	);

	foreach ( $os_array as $regex => $value ) { 
		if ( preg_match($regex, $user_agent ) ) {
			$os_platform = $value;
		}
	}   
	return $os_platform; 
}

function get_user_device_name()
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

	$device_name =   "Unknown";
	$device_array =   array(
        '/(sm | samsung)/i'        =>  'Samsung',
		'/(moto | motorola)/i'     =>  'Motorola',
		'/blazer/i'                =>  'Blazer',
		'/palm/i'                  =>  'Palm',
		'/handspring/i'            =>  'Handspring',
		'/nokia/i'                 =>  'Nokia',
		'/kyocera/i'               =>  'Kyocera',
		'/smartphone/i'            =>  'Smartphone',
		'/windows ce/i'            =>  'Windows CE',
		'/blackberry/i'            =>  'Blackberry',
		'/wap/i'                   =>  'Wap',
		'/(sony | sonyericsson)/i' =>  'sony Ericsson',
		'/playstation/i'           =>  'Playstation',
		'/lg/i'                    =>  'LG',
		'/mmp/i'                   =>  'MMP',
		'/opwv/i'                  =>  'OPWV',
		'/symbian/i'               =>  'Symbian',
		'/epoc/i'                  =>  'Epoc',
		'/pixel/i'                 =>  'Google pixel',
		'/nexus/i'                 =>  'Nexus',
		'/ipad/i'                  =>  'iPad',
		'/iphone/i'                =>  'iPhone',
		'/ipod/i'                  =>  'iPod',
		'/microsoft/i'             =>  'Microsoft',
		'/nvidia/i'                =>  'Nvidia',
		'/macintosh/i'             =>  'Macintosh',
		'/(rm | realme)/i'         =>  'Realme',
		'/vivo/i'                  =>  'Vivo',
		'/oppo/i'                  =>  'Oppo',
		'/infinix/i'               =>  'Infinix',
		'/(ntn | kob)/i'           =>  'Huawei',
		'/(redmi | xiaomi)/i'      =>  'Xiaomi',
		'/techno/i'                =>  'Techno',
		'/lenovo/i'                =>  'Lenovo',
		'/voda/i'                  =>  'Vodaphone',
		'/asus/i'                  =>  'Asus',
		'/acer/i'                  =>  'Acer',
		'/alcatel/i'               =>  'Alcatel',
		'/gionee/i'                =>  'Gionee',
		'/fair/i'                  =>  'Fairphone',
		'/dell/i'                  =>  'Dell',
		'/msi/i'                   =>  'MSi',
		'/toshiba/i'               =>  'Toshiba',
		'/ibm/i'                   =>  'IBM',
		'/intel/i'                 =>  'Intel',
		'/razer/i'                 =>  'Razer',
		'/compaq/i'                =>  'Compaq',
		'/gigabyte/i'              =>  'Gigabyte',
		'/alienware/i'             =>  'Alienware',
		'/fujitsu/i'               =>  'Fujitsu',
		'/nec/i'                   =>  'NEC',
		'/gateway/i'               =>  'Gateway',
		'/commodore/i'             =>  'Commodore',
		'/evga/i'                  =>  'Evga',
		'/corsair/i'               =>  'Corsair Gaming',
		'/elitegroup/i'            =>  'Elitegroup Computer Systems',
		'/falcon/i'                =>  'Falcon Northwest',
		'/htc/i'                   =>  'HTC'
	);

	foreach ( $device_array as $regex => $value ) { 
		if ( preg_match($regex, $user_agent ) ) {
			$device_name = $value;
		}
	}   
	return $device_name; 
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
        $query .= " last_logout = NULL,";
    }
    elseif($level = 2)
    {
        $query .= " last_login = NULL,";
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

//update user table by setting active to 1
function set_active_to_1($id)
{
    $db = new dbase('bwajes+');
    $query = "UPDATE users SET active = :active WHERE id = :id";
    $db->prep($query);

    $db->bindvalue(':id', $id, 'int');
    $db->bindvalue(':active', 1, 'int');

    $execute = $db->execute();
    
    return $execute;
}

function delete_single_row($value, $column_name = 'id', $table_name, $type='str', $dbname='bwajes+')
{
    

    $db = new dbase($dbname);

    $query = "DELETE FROM $table_name WHERE $column_name = :value";

    $db->prep($query);

    $db->bindvalue(':value', $value, $type);

    $execute = $db->execute();

    return $execute;
}

//inserting values into email list table

function insert_into_forgot_password(array $values, $dbname='bwajes+')
{
    

    $db = new dbase($dbname);

    $query = "INSERT INTO forgot_password(email, selector, token, expires) VALUES(:email, :selector, :token, :expires)";

    $db->prep($query);

    $db->bindvalue(':email', $values['email'], 'str');
    $db->bindvalue(':selector', $values['selector'], 'str');
    $db->bindvalue(':token', $values['token'], 'str');
    $db->bindvalue(':expires', $values['expires'], 'str');

    $execute = $db->execute();

    return $execute;
}

//selecting tokens that have not expired
function fetch_forgot_password(array $value, $dbname='bwajes+')
{
    // 

    $db = new dbase($dbname);

    $query = "SELECT * FROM forgot_password WHERE selector = :selector AND expires >= :current_time";
    $db->prep($query);
    $db->bindvalue(':selector', $value['selector'], 'str');
    $db->bindvalue(':current_time', $value['current_time'], 'str');
    $row = $db->fetchSingle();
    return $row;
}

//update user statistics table

function update_user_password(array $value, $dbname='bwajes+')
{
    

    $db = new dbase($dbname);

    $query = "";
    $query .= "UPDATE users SET";
    $query .= " password = :password WHERE email = :email";
    $db->prep($query);

    $db->bindvalue(':email', $value['email'], 'str');
    $db->bindvalue(':password', $value['password'], 'str');

    $execute = $db->execute();

    return $execute;
}

// End database queries


?>
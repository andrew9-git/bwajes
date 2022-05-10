
<?php
ob_start();
session_start();
include_once('includes/functions.php');
$csrf = csrf_token();
function bwajes_plus_header($title, $description)
{?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <!-- <meta name="keywords" content="my, keywords"> -->
    <!-- <meta name="author" content="name, email@gmail.com"> -->
    <meta name="copyright" content="Andadel">
    <!-- <meta name="description" content=""> -->
    <?php 
        if(!empty($description))
        {
            echo '<meta name="description" content="'. $description.'">'; 
        }
    ?>
    <meta name="robots" content="noindex, nofollow">

    <!-- This is for social media sharing -->

    <!-- <meta property="og:title" content="my title">
    <meta property="og:url" content="https://andadel.com/">
    <meta property="og:image" content="https://andadel.com/images">
    <meta property="og:type" content="article/website">
    <meta property="og:description" content="my description"> -->
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../images/bwajes_plus.png">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="nav">
        <div class="nav-content">
            <div class="logo">
                <div class="logo-image">
                    <a href="../about"><img src="../images/bwajes_plus.png" alt="logo"></a>
                </div>
                <span>bwajes+</span>
            </div>
            <input type="checkbox" id="click">
            <label for="click" class="menu-btn">
                <i class="bx bx-menu"></i>
            </label>
            <ul class="nav-items">
            <?php 
                if(basename($_SERVER['PHP_SELF']) !== "login.php")
                {?>
                 <li><a href="login" class="btn">Login</a></li>
                <?php } ?>
                <?php 
                if(basename($_SERVER['PHP_SELF']) !== "register.php")
                {?>
                 <li><a href="../register" class="btn btn-warning" id="get-started">Get started</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
<?php
}
?>
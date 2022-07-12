<?php
include('includes/email-template.php');

if(isset($_GET['eid']))
{
    $id = $_GET['id'];
}
//Not yet complete. To be completed when i will be sending bulk messages
email_template();

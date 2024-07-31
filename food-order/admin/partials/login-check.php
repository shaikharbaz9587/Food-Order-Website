<?php

//authorization - access control
//check whether user loged in or not
if(!isset($_SESSION['user']))  //if user session is not set
{
    // user is not loged in
    //redirect to login.php
    $_SESSION['no-login-massage']="<div class='error text-center'> Please Login to Access Admin Panel</div>";
    header("location:".SITEURL."/admin/login.php");
}


?>
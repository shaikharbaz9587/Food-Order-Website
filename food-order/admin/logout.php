<?php

//db file for SITEURL
include("C:/xampp/htdocs/food-order/admin/confige/db_connection.php");

//destroye all sessions
session_destroy();

//redirect to login page
header("location:".SITEURL."/admin/login.php")

?>
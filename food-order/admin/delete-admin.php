<?php

include('C:\xampp\htdocs\food-order\admin\confige\db_connection.php'); 


//1. get the id of admin to be deleted
 $id=$_GET['id'];

//2. create a aql query to delete admin
    $sql="DELETE from tbl_admin where id=$id";

// execute the query
$result=mysqli_query($conn,$sql);

//check query executed or not
if($result==True){

    // echo "Admin deleted";
    //create a session variable to display massage
    $_SESSION['delete']="<div class='success'> Admin Deleted Succesfully. </div>";
    header("location:".SITEURL.'/admin/manage-admin.php');
}
else{
    // echo "admin not deleted";
    $_SESSION['delete']=" <div class='error'> Failed to Delete Admin. Try Again Later. </div>";
    header("location:".SITEURL.'/admin/manage-admin.php');
}

// 3. redirectt to manage-admin page



?>
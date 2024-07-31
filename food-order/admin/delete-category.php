<?php

//include db connection file
include('C:\xampp\htdocs\food-order\admin\confige\db_connection.php');


//check whether the id and image_name value set or not
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    //get value and delete
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];
    //remove the physical file is available
    if($image_name != ""){
        //image is available so remove it
        
        $path="../images/category/".$image_name;
        //remove the image
        $remove= unlink($path);
        //if failed to remove image then add an error massage and stop proccess
        if($remove==false){
                //set session massage
                $_SESSION['remove']="<div class='error'>Failed to Remove Category Image</div>";
                //redirect to page
                header("location:".SITEURL."/admin/manage-category.php");
                //stop the proccess
                die();
        }


    }
    // delete data from database
    $sql = "DELETE from tbl_category where id=$id";

    //execute query
    $result=mysqli_query($conn, $sql);
    //check whether data is delete or not
    if($result==true){
        $_SESSION['delete']="<div class='success'> Category Deleted Successfully</div>";
                //redirect to page
                header("location:".SITEURL."/admin/manage-category.php");
    }
    else{
        $_SESSION['delete']="<div class='error'>Failed to Delete Category </div>";
                //redirect to page
                header("location:".SITEURL."/admin/manage-category.php");
    }

}

else{
    header("location:".SITEURL."/admin/manage-category.php");

}

?>
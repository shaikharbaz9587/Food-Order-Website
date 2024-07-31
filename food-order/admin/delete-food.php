<?php
//include db connection file
include('C:/xampp/htdocs/food-order/admin/confige/db_connection.php');


if(isset($_GET['id']) && isset($_GET['image_name'])){

    //process to delete
    //1. get id and image name
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];
    //2. remove the image if available
    //check the image is avilable or not delete if available
    if($image_name!=""){
        $path="../images/food/".$image_name;

        $remove=unlink($path);
        //check image is removed or not
        if($remove==false){

            $_SESSION['remove']=" <div class='error'>  Failed to Remove Image File</div>";
            header("location: ".SITEURL."/admin/manage-food.php");
           die();
        }
        
    }

    //delete from db
    $sql="DELETE from tbl_food where id=$id";
    //execute the query
    $res=mysqli_query($conn,$sql);
    //check query execute or not
    if($res==true){
        $_SESSION['delete-food']=" <div class='success'> Food Deleted Successfully </div>";
        header("location: ".SITEURL."/admin/manage-food.php");
    }
    else
    {
        $_SESSION['delete-food']=" <div class='error'> Failed to Delete Food </div>";
        header("location: ".SITEURL."/admin/manage-food.php");
    }

}
else
{
    $_SESSION['delete']=" <div class='error'>  Unauthorized Access</div>";
    header("location: ".SITEURL."/admin/manage-food.php");
   die();
}

?>
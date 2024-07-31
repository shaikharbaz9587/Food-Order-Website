<?php include('partials/menu.php'); ?>
<br><br>
<div class="main-container">
    <div class="wrapper">
        <h1>CHANGE PASSWORD</h1>
        <br><br>


        <?php
    //1. get the id of selected admin
    $id=$_GET['id'];
   
?>


        <form action="" method="POST">

        <table>
            <tr>
                <td>Old Password: </td>
                <td><input type="password" name=" current_password" placeholder="Enter Current Password"></td>
            </tr>
            <tr>
                <td>New Password: </td>
                <td><input type="password" name="new_password" placeholder="Enter New Password"></td>
            </tr>

            <tr>
                <td>Confirm Password: </td>
                <td><input type="password" name="confirm_password" placeholder="Enter Confirm Password"></td>
            </tr>

            <tr>
            
            <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                 <input type="submit" name="submit" value="Change Password" class="btn-secondary">
        </td>
        </tr>
        </table>

        </form>


    </div>
</div>


<?php
    //1.check whether the submit button click or not
    if(isset($_POST['submit'])){  
       
        $id=$_POST['id'];
        $current_password=$conn->real_escape_string(md5($_POST['current_password']));
        $new_password=$conn->real_escape_string(md5($_POST['new_password']));
        $confirm_password=$conn->real_escape_string(md5($_POST['confirm_password']));

    //2.check user with current Id and password is exist or not

    $sql="SELECT * FROM tbl_admin WHERE id=$id and password='$current_password'";

    //execute the query
    $result= mysqli_query($conn, $sql);

    if($result==true){
        //check the data is available or not
        $count=mysqli_num_rows($result);
        if($count==1){
            
            //check new password and confirm pw match or not
            if($new_password==$confirm_password){

                //query to change pw
                $sql2="UPDATE tbl_admin SET 
                password='$new_password'
                where id=$id";

                //execute the query
                $res2=mysqli_query($conn,$sql2);

                //check query executed or not
                if($res2==true){

                    $_SESSION['pw_change']="<div class='success'> Password Changed </div>";
                //redirect the user
                header("location:".SITEURL.'/admin/manage-admin.php');  

                }
                else{
                    $_SESSION['pw_change']="<div class='error'> Password Did Not Changed </div>";
                //redirect the user
                header("location:".SITEURL.'/admin/manage-admin.php');  

                }

            }
            else
            {
                $_SESSION['pw_not_match']="<div class='error'> Password Did Not Match </div>";
                //redirect the user
                header("location:".SITEURL.'/admin/manage-admin.php');   
            }
        }
        else
        {
            $_SESSION['User_Not_Found']="<div class='error'> User Not Found </div>";
            //redirect the user
            header("location:".SITEURL.'/admin/manage-admin.php');
        }
    }

    //3.

    //4.change password if all above is true
    }
?>

<br><br><br> 

<?php include('partials/footer.php'); ?>
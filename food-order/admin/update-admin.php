<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>UPDATE ADMIN</h1>

        <br><br>

    <?php

    //1. get the id of selected admin
    $id=$_GET['id'];
    //2. create sql query to get the details
    $sql = "SELECT * from tbl_admin where id=$id";
    //3. execute the query
    $result=mysqli_query($conn,$sql);

    //check wehther the query executed or not
    if($result==True){
        //check data is available or not
        $count=mysqli_num_rows($result);

        if($count==1){
            //get the dtails
            $row=mysqli_fetch_assoc($result);

            $full_name=$row['full_name'];
            $username=$row['username'];
        }
        else
        {
            //redirect to manage admin
            header("location:".SITEURL.'/admin/manage-admin.php');
        }

    }
?>


        <form action="" method="POST">

        <table class="tbl-30">
        <tr>
            <td>Full Name: </td>
            <td><input type="text" name=full_name value=" <?php echo $full_name;  ?>"></td>
        </tr>
        <tr>
            <td>UserName: </td>
            <td><input type="text" name="username" value=" <?php echo $username;  ?>"></td>
        </tr>
        <tr>
            
            <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                 <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
        </td>
        </tr>
        </table>

        </form>

    </div>
</div>

<?php
    if(isset($_POST['submit'])){
        //echo "btn clicked";
        
        //get all values from form to update
        $id=$_POST['id'];
        $full_name=$conn->real_escape_string($_POST['full_name']);
        $username= $conn->real_escape_string($_POST['username']);

        //create a sql query to update admin
        $sql="UPDATE tbl_admin SET 
        full_name='$full_name',
        username='$username' where id='$id'";

        //execute the query
        $result= mysqli_query($conn,$sql);

        //check the query execute or not
        if($result==true){
            $_SESSION['update']=" <div class='success'>Admin Updated.</div> ";
            header("location:".SITEURL."/admin/manage-admin.php");
        }
        else
        {
            $_SESSION['update']=" <div class='error'>Admin Not Updated.</div> ";
            header("location:".SITEURL."/admin/manage-admin.php");
        }

    }
?>

<?php include('partials/footer.php'); ?>
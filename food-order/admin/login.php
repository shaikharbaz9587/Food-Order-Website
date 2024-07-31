
<?php include("C:/xampp/htdocs/food-order/admin/confige/db_connection.php");  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1>

        <br>
        <?php
          if(isset($_SESSION['login'])){
            echo $_SESSION['login'];  // display session massege
            unset ($_SESSION['login']);  // removing session massege
        }


        if(isset($_SESSION['no-login-massage'])){
            echo $_SESSION['no-login-massage'];  // display session massege
            unset ($_SESSION['no-login-massage']);  // removing session massege
        }
        ?>

    <!-- login for start -->
        <br><br>
    <form action="" method="post" class="text-center">

        User Name: <br>
        <input type="text" name="username" placeholder="Enter User Name"><br><br>


        Password: <br>
        <input type="password" name="password" placeholder="Enter User Password"><br><br>

        <input type="submit" name="submit" value="Login" class="btn-primary">

    </form><br>


    <!-- login form end -->

    <p class="text-center"> Created By<a href="#">Team</a></p>
    </div>
    
</body>
</html>


<?php   

if(isset($_POST['submit'])){

    //get the data from login form
    $username =$conn->real_escape_string($_POST['username']);
    $password= $conn->real_escape_string(md5($_POST['password']));

    //sql query to check username and password exist or not
    $sql="SELECT * from tbl_admin where username='$username' AND password='$password'";

    //execute query
    $result = mysqli_query($conn,$sql);

    //count rows to check user exist or not
    $count=mysqli_num_rows($result);

    if($count==1){

        $_SESSION['login'] = "<div class='success'> Login Successfully</div>";
        $_SESSION['user']= $username;//to check user is loged in or not and logout will unset it 

        header("location:".SITEURL."/admin");
        
    }
    else{
        $_SESSION['login'] = "<div class='error text-center'> User Name or Password Did Not Match</div>";
        header("location:".SITEURL."/admin/login.php");
    }

}

?>
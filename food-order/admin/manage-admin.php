<?php  include('partials/menu.php');  ?>



    <!-- main content section start -->
    <div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>

        <br /><br />

        <?php  
        //this ssesion for add admin
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];  // display session massege
            unset ($_SESSION['add']);  // removing session massege
        }

        //this session for delete admin
        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];  // display session massege
            unset ($_SESSION['delete']);  // removing session massege
        }

        //this session for update admin
        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];  // display session massege
            unset ($_SESSION['update']);  // removing session massege
        }

        //this session for not update in password
        if(isset($_SESSION['User_Not_Found'])){
            echo $_SESSION['User_Not_Found'];  // display session massege
            unset ($_SESSION['User_Not_Found']);  // removing session massege
        }

        //this session for new password and confirm password did not match
        if(isset($_SESSION['pw_not_match'])){
            echo $_SESSION['pw_not_match'];  // display session massege
            unset ($_SESSION['pw_not_match']);  // removing session massege
        }


        //this session for pw change
        if(isset($_SESSION['pw_change'])){
            echo $_SESSION['pw_change'];  // display session massege
            unset ($_SESSION['pw_change']);  // removing session massege
        }
        
        //this session for login
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];  // display session massege
            unset ($_SESSION['login']);  // removing session massege
        }

        ?>
        <br /><br /><br />

        <!-- button to add admin -->
         <a href="add-admin.php" class="btn-primary">Add Admin</a>

         <br /><br /><br />


        <table class="table_full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
            // query to get all admin
            $sql = "SELECT * FROM tbl_admin";

            // execute the query
            $result = mysqli_query($conn,$sql);

            //check query execute or not
            if($result==True){
                //count rows to check we have data or not in database
                $count=mysqli_num_rows($result);//function to get all the rows in database
                    
            $sn=1;

                //check the number of rows
                if($count>0){
                    //we have data in database
                    while($rows=mysqli_fetch_assoc($result)){
                        // using while loop to get all the data from database
                        //and while loop run until as long as we have data in database

                        //get individual data
                        $id=$rows['id'];
                        $full_name=$rows['full_name'];
                        $username=$rows['username'];

                        //display the values in our table
                        
                        ?>

                        <tr>
                <td> <?php echo $sn++;  ?> </td>
                <td><?php echo $full_name;  ?></td>
                <td><?php echo $username;  ?></td>
                <td>
                    <a href="/food-order\admin\update-admin.php ?id=<?php echo $id;  ?>" class="btn-secondary">Update Admin</a>
                    <a href="/food-order\admin\delete-admin.php ?id=<?php echo $id;  ?>" class="btn-danger">Delete Admin</a>
                    <a href="/food-order\admin\update-password.php ?id=<?php echo $id;  ?>" class="btn-primary">Update Password</a>

                </td>
            </tr>

                        <?php
                    }

                }
                else{
                    // we do not have data in database
                }
            }
            ?>

        </table>

        </div>
        
    </div>

    <!-- main content section end -->

    <?php include('partials/footer.php');    ?>
    
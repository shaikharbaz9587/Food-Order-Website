<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br /><br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];  // display session message
            unset($_SESSION['add']);  // removing session message
        }
        ?>
        <br /><br />

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter your Name"></td>
                </tr>

                <tr>
                    <td>UserName:</td>
                    <td><input type="text" name="username" placeholder="Enter your UserName"></td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="pw" placeholder="Enter your Password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>

<?php include('partials/footer.php'); ?>

<!-- process the value from form to database -->
<?php
if (isset($_POST['submit'])) {
    // 1. Get the data from form
    $full_name = isset($_POST['full_name']) ? $_POST['full_name'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['pw']) ? md5($_POST['pw']) : '';

    // 2. SQL query to insert data into table
    $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username='$username',
            password='$password'";

    // 3. Execute query and save data into database
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    // 4. Check data inserted or not
    if ($result == true) {
        // Create a session variable to display message
        $_SESSION['add'] = "<div class='success'> Admin added successfully.</div>";
        header("location:" . SITEURL . '/admin/manage-admin.php');
    } else {
        $_SESSION['add'] = " <div class='error'> Failed to add admin. </div>";
        header("location:" . SITEURL . '/admin/add-admin.php');
    }
}
?>

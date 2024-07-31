<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br>


        <?php

            //this session for add category
            if(isset($_SESSION['add'])){
            echo $_SESSION['add'];  // display session massege
            unset ($_SESSION['add']);  // removing session massege
            }


             //this session for upload image
             if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];  // display session massege
                unset ($_SESSION['upload']);  // removing session massege
                }

        ?>
        <br>
        <!-- add category form start -->

        <form action="" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>
                        Title:
                    </td>
                    <td><input type="text" name="title" placeholder="Category Title"></td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                
                <tr>
                    <td>Featured:</td>  <br>
                    <td>
                        <input type="radio" name="featured" value="YES">YES 
                        <input type="radio" name="featured" value="NO">NO
                    </td>
                </tr>
                
                <tr>
                    <td>Active:</td>
                    <td>
                    <input type="radio" name="active" value="YES">YES 
                    <input type="radio" name="active" value="NO">NO 
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add-Category" class="btn-secondary"> 
                    </td>
                    
                    
                   
                    
                </tr>

            </table>
        </form>
        <!-- add category form end -->

        <?php

        // check the submit button clicked or not
        if(isset($_POST['submit'])){
            //get the value from category form
            $title=$conn->real_escape_string($_POST['title']);

            //for radio input we need to check button selected or not
            if(isset($_POST['featured'])){
                //get the value from form
                $featured=$_POST['featured'];
            }
            else
            {   
                //set default
                $featured="NO";
            }

            //same for active

            //for radio input we need to check button selected or not
            if(isset($_POST['active'])){
                //get the value from form
                $active=$_POST['active'];
            }
            else
            {   
                //set default
                $active="NO";
            }

            //check the image is selected or not
            // print_r($_FILES['image']);
            // die();

            if(isset($_FILES['image']['name'])){
                //upload image                    
                //to upload image we need source path and destination path

                $image_name=$_FILES['image']['name'];

                //upload the image only if image is selected
                if($image_name!=""){

                //auto rename of image
                //get the extension of image like(jpg, png, gif, etc)
                
                
                
               // $extension = end(explode('.',$image_name));



                //rename the image when you want


                //$image_name = "put_name_what_you_want".rand(000,999).'.'.$extension;



                $source_path=$_FILES['image']['tmp_name'];
                $destination_path= "../images/category/".$image_name;

                //finally upload the image
                $upload=move_uploaded_file($source_path, $destination_path);

                //check image is uploaded or not if not then give a error massege
                if($upload==false){
                    $_SESSION['upload']="<div class='error'> Failed to Upload Image </div>";
                    header("location:".SITEURL."/admin/add-category.php");
                    //to stop the proccess
                    die();
                }
            }
            }
            else
            {
                $image_name="";
            }



            // create a sql query to insert category into database
            $sql="INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'

            ";

            //3. execute the query save in database
            $resul=mysqli_query($conn,$sql);

            //4.check query executed or not and data saved or not
            if($resul==true){
                //query executed and category added
                $_SESSION['add']=" <div class='success'> Category Added </div>";
                header("location:".SITEURL."/admin/manage-category.php");
            }
            else
            {
                $_SESSION['add']=" <div class='error'> Category Failed to Add </div>";
                header("location:".SITEURL."/admin/add-category.php");

            }


        }

        ?>

    </div>
</div>




<?php include('partials/footer.php'); ?>
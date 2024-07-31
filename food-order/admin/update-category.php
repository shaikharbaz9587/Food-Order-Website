<?php include('partials/menu.php');  ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <!-- get the value of all selected id -->
        <?php

        //check whether id is set or not
        if(isset($_GET['id'])){
            $id=$_GET['id'];

            //sql query
            $sql="SELECT * from tbl_category where id=$id";

            //execute the query
            $result=mysqli_query($conn,$sql);

            //count the rows to check id is valid or not
            $count=mysqli_num_rows($result);

            if($count==1){
                $row=mysqli_fetch_assoc($result);
                $title=$row['title'];
                $current_image=$row['image_name'];
                $featured=$row['featured'];
                $active=$row['active'];
                
            }
            else
            {
                $_SESSION['no-category-found']=" <div class='error'> Category not Found </div>";
                header("location:".SITEURL."/admin/manage-category.php");
            }
        }
        else
        {
            header("location:".SITEURL."/admin/manage-category.php");

        }



        ?>

        <form action="" method="post" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title: </td>
                <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
            </tr>
            <tr>
                <td>Current Image</td>
                <td><?php
                    if($current_image !=""){
                        //display Image
                        ?>
                        <img src="<?php echo SITEURL; ?>/images/category/<?php echo $current_image;?>" width="150px">
                        <?php
                    }else
                    {
                        echo "<div class='error'> Image not Added</div>";
                    }
                ?>
                </td>
            </tr>
            <tr>
                <td>New Image: </td>
                <td><input type="file" name="image"></td>
            </tr>
            <tr>
                <td>Featured: </td>
                <td>
                    <input  <?php if($featured=="YES"){echo "checked";} ?> type="radio" name="featured" value="YES">YES
                    <input  <?php if($featured=="NO"){echo "checked";} ?> type="radio" name="featured" value="NO">NO

                </td>
            </tr>

            <tr>
                <td>Active: </td>
                <td>
                    <input <?php if($active=="YES"){echo "checked";} ?> type="radio" name="active" value="YES">YES
                    <input <?php if($active=="NO"){echo "checked";} ?> type="radio" name="active" value="NO">NO

                </td>
            </tr>

            <tr>
                <td>
                    
                    <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                    <input type="hidden" name="id" value="<?php echo $id;?>">

                </td>
            </tr>

        </table>
        </form>

        <?php
        //php for button clicked or not
        if(isset($_POST['submit'])){
            //echo "clicked";
            //get the values from form
            $id=$_POST['id'];
            $title=$conn->real_escape_string($_POST['title']);
            $featured=$_POST['featured'];
            $active=$_POST['active'];
            
            // A.update new image if selected
            
            //check the image is selected or not
            if(isset($_FILES['image']['name'])){
                $image_name=$_FILES['image']['name'];
                //check image is available or not    
                if($image_name!=""){
                    //upload the new image
                    //remove the current image
                    $source_path=$_FILES['image']['tmp_name'];
                $destination_path= "../images/category/".$image_name;

                //finally upload the image
                $upload=move_uploaded_file($source_path, $destination_path);

                //check image is uploaded or not if not then give a error massege
                if($upload==false){
                    $_SESSION['upload']="<div class='error'> Failed to Upload Image </div>";
                    haeder("location:".SITEURL."/admin/manage-category.php");
                    //to stop the proccess
                    die();
                }

                    //B. remove the current image if available
                    if($current_image!=""){

                        $remove_path="C:/xampp/htdocs/food-order/images/category".$current_image;
                    $remove=unlink($remove_path);
                    
                    //check image removed or not
                    //if not thant display massage and stop proccess

                    if($remove==false){
                        $_SESSION['failed-remove']="<div class='error'> Failed to Remove Current Image</div>";
                        header("location:".SITEURL."/admin/manage-category.php");
                        die();
                    }

                    }
                
                }
                else
                {
                    $image_name=$current_image;
                }
            }
            else{
                $image_name=$current_image;
            }

            //update the database
            $sql2="UPDATE tbl_category set
            title='$title',
             image_name='$image_name',
            featured='$featured',
            active='$active'
            where id=$id";

            //execute the query
            $res=mysqli_query($conn,$sql2);

            //checke query executed or not
            if($res==true){
                $_SESSION['update']="<div class='success'>Category Updated</div>";
                header("location:".SITEURL."/admin/manage-category.php");

            }
            else{
                $_SESSION['update']="<div class='error'> Failed to Updated Category </div>";
                header("location:".SITEURL."/admin/manage-category.php");

            }

            //redirect to manage category page



        }


        ?>
        
    </div>
</div>





<?php include('partials/footer.php');  ?>

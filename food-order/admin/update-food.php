<?php include('partials/menu.php'); ?>

<?php 
//check whether id is set or not
if(isset($_GET['id'])){
    $id=$_GET['id'];

    //sql query to get the selected food
    $sql2="SELECT * from tbl_food where id=$id";

    // execute query
    $res2=mysqli_query($conn, $sql2);

    // get the value based on query
    $row2=mysqli_fetch_assoc($res2);
    //get individual value of food
    $title=$row2['title'];
    $description=$row2['description'];
    $price=$row2['price'];
    $current_image=$row2['image_name'];
    $current_category=$row2['category_id'];
    $featured=$row2['featured'];
    $active=$row2['active'];

}
else
{
    header("location:".SITEURL."/admin/manage-food.php");
}

?>



<div class="main-content">
<div class="wrapper">
    <h1>Update Food</h1>
<br><br>

    <!-- update-food form start -->

    <form action="" method="POST" enctype="multipart/form-data">

<table>
        <tr>
            <td>
                Title: 
            </td>
            <td><input type="text" name="title" placeholder="Enter Food Title" value="<?php echo $title; ?>"></td>
        </tr>

        <tr>
            <td>
                Description:
            </td>
            <td>
            <textarea name="description" cols="30" rows="5" placeholder="Enter Description About Food">
                <?php
                $description;
                ?>
            </textarea>
            </td>
        </tr>


        <tr>
            <td>
                Price:
            </td>
            <td><input type="number" name="price" value="<?php echo $price;  ?>"></td>
        </tr>

        <tr>
            <td>Current Image:</td>
            <td>
                <?php
                if($current_image==""){
                    echo "<div class='error'>Image Not Available</div>";
                }
                else
                {
                    ?>
                    <img src="<?php echo SITEURL; ?>/images/food/<?php echo $current_image; ?>" alt="<?php echo $title; ?>" width="100px">
                    <?php
                }
                ?>
            </td>
        </tr>

        <tr>
            <td>Select New Image:</td>
            <td><input type="file" name="image"></td>
        </tr>

        <tr>
            <td>Category:</td>
            <td><select name="category">

        <?php
            //php code to display categories from db
            //1.sql to get all active categories from db

            $sql="SELECT * from tbl_category where active='YES'";
            //executing query
            $res= mysqli_query($conn, $sql);

            //count rows to check we have categories or not
            $count= mysqli_num_rows($res);
            
            //
            if($count>0){
                while($row=mysqli_fetch_assoc($res)){
                    $category_id=$row['id'];
                    $category_title=$row['title'];
                   ?>

                <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

                   <?php
                }                        

            }
            else
            {

                ?>
                <option value="0">No Category Found</option>
                <?php

            }


            //2.display on dropdown

        ?>

        
            </select></td>
        </tr>

        
        <tr>
            <td>Featured</td>  <br>
            <td>
                <input <?php if($featured=="YES"){echo"checked";} ?> type="radio" name="featured" value="YES">YES 
                <input <?php if($featured=="NO"){echo"checked";} ?> type="radio" name="featured" value="NO">NO
            </td>
        </tr>
        
        <tr>
            <td>Active</td>
            <td>
            <input <?php if($active=="YES"){echo"checked";} ?> type="radio" name="active" value="YES">YES 
            <input <?php if($active=="NO"){echo"checked";} ?> type="radio" name="active" value="NO">NO 
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="Update-Food" class="btn-secondary"> 
                <input type="hidden" name="id" value="<?php echo $id; ?>"> 
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>"> 

            </td>
            
            
           
            
        </tr>

    </table>

</form>
        <br>

        <!-- update-food form end -->

 <?php
    //check update button clicked or not
    if(isset($_POST['submit'])){
            // echo "button clicked";
        
        //1. get all the details from form
            $id=$_POST['id'];
            $title=$conn->real_escape_string($_POST['title']);
            $description=$conn->real_escape_string($_POST['description']);
            $price=$_POST['price'];
            $current_image=$_POST['current_image'];
            $category=$_POST['category'];

            $featured=$_POST['featured'];
            $active=$_POST['active'];


        //2.upload the image if selected

        

        if(isset($_FILES['image']['name'])){

            $image_name=$_FILES['image']['name'];

            //  A.upload new image

            if($image_name!=""){
                //rename the image
               
                $extention=end(explode('.',$image_name)); //get the extension of image like (jpg,png,etc)
                $image_name="Food-Name-".rand(0000,9999).'.'.$extention;//this will be renamed image

                //get the source pathe and destination path
                $source_path=$_FILES['image']['tmp_name'];

                $destination_path="../images/food/".$image_name;

                //upload the image
                $upload=move_uploaded_file($source_path,$destination_path);

                //check updated image is uploaded or not
                if($upload==false){
                    $_SESSION['updated-upload']=" <div class='error'>  Failed to Upload Iamge</div>";
                    header("location:".SITEURL."/admin/manage-food.php");
                    die();

                }


                  //3.remove the current image if new image is selected
                //  B. remove current image if available
                if($current_image!=""){
                    $remove_path="../images/food/".$current_image;
                    $remove=unlink($remove_path);

                    //check image is removed or not
                    if($remove==false){
                        $_SESSION['remove-failed']=" <div class='error'>  Failed to remove current Iamge</div>";
                    header("location:".SITEURL."/admin/manage-food.php");
                    die();
                    }

                }
                
               
            }
            else{
                $image_name=$current_image;
            }
        }
        else
        {
            $image_name=$current_image;
        }


        
        //4.update the food in db
        $sql3="UPDATE tbl_food SET
            title='$title',
            description='$description',
            price=$price,
            image_name='$image_name',
            category_id=$category,
            featured='$featured',
            active='$active'
            where id=$id";

            //execute the query
            $res3=mysqli_query($conn,$sql3);

            //check the query executed or not
            if($res3==true){
                $_SESSION['update']=" <div class='success'> Food Updated Successfully </div>";
                header("location:".SITEURL."/admin/manage-food.php");
                die();
            }
            else{
                $_SESSION['update']=" <div class='error'>  Failed to Update Food</div>";
                header("location:".SITEURL."/admin/manage-food.php");
                die();
            }
        //5. redirect to manage-food page
    }   
    else
    {

    }


?>



</div>
</div>




<?php include('partials/footer.php'); ?>

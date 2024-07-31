<?php include('partials/menu.php'); ?>

<div class="main-container">
    <div class="wrapper">
    <br><br><br>
        <h1>Add Food</h1>
        <br><br>

        <?php

            //this session massage for upload image
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];  // display session massege
            unset ($_SESSION['upload']);  // removing session massege
            }


        ?>
        <br><br>
        <!-- add-food form start -->

        <form action="" method="POST" enctype="multipart/form-data">

        <table>
                <tr>
                    <td>
                        Title: 
                    </td>
                    <td><input type="text" name="title" placeholder="Enter Food Title"></td>
                </tr>

                <tr>
                    <td>
                        Description:
                    </td>
                    <td>
                    <textarea name="description" cols="30" rows="5" placeholder="Enter Description About Food"></textarea>
                    </td>
                </tr>


                <tr>
                    <td>
                        Price:
                    </td>
                    <td><input type="number" name="price"></td>
                </tr>

                <tr>
                    <td>Select Image:</td>
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
                            $id=$row['id'];
                            $title=$row['title'];
                           ?>

                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

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
                        <input type="radio" name="featured" value="YES">YES 
                        <input type="radio" name="featured" value="NO">NO
                    </td>
                </tr>
                
                <tr>
                    <td>Active</td>
                    <td>
                    <input type="radio" name="active" value="YES">YES 
                    <input type="radio" name="active" value="NO">NO 
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add-Food" class="btn-secondary"> 
                    </td>
                    
                    
                   
                    
                </tr>

            </table>

        </form>
        <br><br><br>

        <!-- add-food form end -->

    <?php
    //check button is clicked or not
    if(isset($_POST['submit'])){

        //add food in database
        // echo "clicked";

        //1. get the data from form
        $title=$conn->real_escape_string($_POST['title']);
        $description=$conn->real_escape_string($_POST['description']);
        $price=$_POST['price'];
        $category=$_POST['category'];

        //radio button for featured and active checked or not
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


        //2. upload the image if selected
        //check the selected image is clicked or not and upload the image only if the image is selected
        if(isset($_FILES['image']['name'])){
            //get the detailes of selected image
            $image_name=$_FILES['image']['name'];

            //upload image only if selected
            if($image_name!=""){
                

                  //auto rename of image
                //get the extension of image like(jpg, png, gif, etc)
                
                
                
               //$extension = end(explode('.',$image_name));



                //rename the image when you want


                //$image_name = "put_name_what_you_want".rand(000,999).'.'.$extension;



                //get the source path and destinetion path
                //source path is the current location of the image
                $src=$_FILES['image']['tmp_name'];

                //destinetion path for the image to be uploaded
                $dst="../images/food/".$image_name;

                //finally upload the food image
                $upload=move_uploaded_file($src,$dst);

                //check image uploaded or not
                if($upload==false){
                    $_SESSION['upload']="<div class='error'> Failed to Upload Food Image </div>";
                    header("location:".SITEURL."/admin/add-food.php");
                    //to stop the proccess
                    die();
                }
            }
        }
        else
        {
            $image_name="";//set default value as blank
        }

        //3.insert into db

        //create a sql query
        $sql2="INSERT INTO tbl_food SET
               title='$title',
               description='$description',
               price=$price,
               image_name='$image_name',
               category_id=$category,
               featured='$featured',
               active='$active' ";

        //execute the query
        $res2=mysqli_query($conn,$sql2);

        // checke data inserted or not
        if($res2==true){
            $_SESSION['add']=" <div class='success'> Food Added </div>";
            header("location:".SITEURL."/admin/manage-food.php");

        }
        else
        {
            $_SESSION['add']=" <div class='error'>  Failed to Add Food</div>";
            header("location:".SITEURL."/admin/manage-food.php");
        }


    }

    

    ?>

    </div>
</div>






<?php include('partials/footer.php'); ?>
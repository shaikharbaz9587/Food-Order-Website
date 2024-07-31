<?php include('partials/menu.php');  ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <br /><br />

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


              //this session massesge for remove image
        if(isset($_SESSION['remove'])){
            echo $_SESSION['remove'];  // display session massege
            unset ($_SESSION['remove']);  // removing session massege
            }

                  //this session massesge for delete category
        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];  // display session massege
            unset ($_SESSION['delete']);  // removing session massege
            }

             //this session massesge for category not found
            if(isset($_SESSION['no-category-found'])){
            echo $_SESSION['no-category-found'];  // display session massege
            unset ($_SESSION['no-category-found']);  // removing session massege
            }

              //this session massesge for update category
              if(isset($_SESSION['update'])){
                echo $_SESSION['update'];  // display session massege
                unset ($_SESSION['update']);  // removing session massege
                }

                 //this session massesge for image upload update category
              if(isset($_SESSION['upload-update'])){
                echo $_SESSION['upload-update'];  // display session massege
                unset ($_SESSION['upload-update']);  // removing session massege
                }

                  //this session massesge for failed to romve image y
              if(isset($_SESSION['failed-remove'])){
                echo $_SESSION['failed-remove'];  // display session massege
                unset ($_SESSION['failed-remove']);  // removing session massege
                }

        ?>
        <br><br>

<!-- button to add category -->
 <a href="/food-order/admin/add-category.php" class="btn-primary">Add Category</a>

 <br /><br /><br />


<table class="table_full">
    <tr>
        <th>S.N.</th>
        <th>Title</Title></th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Actions</th>
        

    </tr>

            <?php
        //query to get category from database
        $sql="SELECT * from tbl_category";


        //execute query
        $result= mysqli_query($conn,$sql);
        
            //count rows
            $count=mysqli_num_rows($result);

            $sn=1;

            //check we have data in databse or not
            if($count>0){
                 while($row=mysqli_fetch_assoc($result)){
                    $id=$row['id'];
                    $title=$row['title'];
                    $image_name=$row['image_name'];
                    $featured=$row['featured'];
                    $active=$row['active'];
                   ?>
                 <tr>
                 <td><?php echo $sn++;  ?></td>
                    <td><?php echo $title;  ?></td>
                    <td>
                        <?php 
                        //check the image_name available or not
                        if($image_name!=""){
                            ?>
                            <img src="<?php echo SITEURL;?>/images/category/<?php echo $image_name;  ?>"width="100px">
                            <?php
                        }
                        else{
                            echo "<div class='error'> Image Not Added</div>";
                        }
                        ?>
                    </td>
                    <td><?php echo $featured;  ?></td>
                    <td><?php echo $active;  ?></td>
                    <td>
                        <a href="/food-order/admin/update-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-secondary">Update Category</a>
                        <a href="/food-order/admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                        
                    </td>
                </tr>

                    <?php

                 }
            }
            else
            {

                ?>
                <tr>
                    <td colspan="60" > <div class="error">No Category Added</div></td>
                </tr>

               <?php 

            }

            ?>

</table>


    </div>
</div>




<?php include('partials/footer.php');  ?>
<?php include('partials/menu.php');  ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>

        <br /><br />

        <?php      

        //this session for add food
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];  // display session massege
            unset ($_SESSION['add']);  // removing session massege
        }

            
        //this session for delete food
        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];  // display session massege
            unset ($_SESSION['delete']);  // removing session massege
        }


        //this session massege for remove image
        if(isset($_SESSION['remove'])){
            echo $_SESSION['remove'];  // display session massege
            unset ($_SESSION['remove']);  // removing session massege
        }


        //this session massege for delete food
        if(isset($_SESSION['delete-food'])){
            echo $_SESSION['delete-food'];  // display session massege
            unset ($_SESSION['delete-food']);  // removing session massege
        }

        //this session massege for updated new image
        if(isset($_SESSION['updated-upload'])){
            echo $_SESSION['updated-upload'];  // display session massege
            unset ($_SESSION['updated-upload']);  // removing session massege
        }


        
        //this session massege for remove current image
        if(isset($_SESSION['remove-failed'])){
            echo $_SESSION['remove-failed'];  // display session massege
            unset ($_SESSION['remove-failed']);  // removing session massege
        }

        //this session massege for update food
        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];  // display session massege
            unset ($_SESSION['update']);  // removing session massege
        }


        ?>
        <br><br>

<!-- button to add food -->
 <a href="/food-order/admin/add-food.php" class="btn-primary">Add Food</a>

 <br /><br /><br />


<table class="table_full">
    <tr>
        <th>S.N.</th>
        <th>Title</th>
        <th>Price</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Actions</th>
        

    </tr>


    <?php

        //create sql query to get all the food
        $sql= "SELECT * from tbl_food";

        //execute the query
        $res=mysqli_query($conn, $sql);

        //count rows to check we have food or not
        $count= mysqli_num_rows($res);
        $sn=1;
        if($count>0){
            while($row=mysqli_fetch_assoc($res)){
                $id=$row['id'];
                $title=$row['title'];
                $price=$row['price'];
                $image_name=$row['image_name'];
                $featured=$row['featured'];
                $active=$row['active'];

                ?>

                <tr>
                        <td><?php echo $sn++; ?> </td>
                        <td><?php echo $title; ?></td>
                        <td><?php echo $price; ?></td>
                        <td>
                             <?php 
                                //check we have image or not
                                if($image_name==""){
                                    echo"<div class='error'> We Do Not Have Image";
                                }
                                else
                                {
                                    ?>
                                        <img src="<?php echo SITEURL;?>/images/food/<?php echo $image_name;?>" width="100px">
                                    <?php
                                }
                             ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="/food-order/admin/update-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class="btn-secondary">Update Food</a>
                            <a href="/food-order/admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                        </td>
                    </tr>

                <?php

            }
        }
        else
        {
            echo "<tr> <td colspan='7' class='error'> Food not Added Yet </td> </tr>";
        }

    ?>


    
</table>

    </div>
</div>




<?php include('partials/footer.php');  ?>
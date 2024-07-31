<?php include('partials-front/menu.php');  ?>

<?php

//check whether id is passed or not
if(isset($_GET['category_id'])){
    //category id is set and get the id
    $category_id=$_GET['category_id'];
    //get the category title based on category_id
    $sql="SELECT title from tbl_category where id=$category_id";

    //execute the query
    $res=mysqli_query($conn, $sql);

    //get the value from db
    $row=mysqli_fetch_assoc($res);
    //get the title
    $category_title=$row['title'];

} 
else
{
    //category id is not passed
    header("location: ".SITEURL);
}

?>


<!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title;  ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
        <?php
    //create a sql query to get foods based on selected category
    $sql2="SELECT * from tbl_food where category_id=$category_id";

    //execute the query
    $res2=mysqli_query($conn,$sql2);

    //count the rows
    $count2=mysqli_num_rows($res2);
    if($count2>0){
        while($row2=mysqli_fetch_assoc($res2)){
            $id=$row2['id'];
            $title=$row2['title'];
            $description=$row2['description'];
            $price=$row2['price'];
            $image_name=$row2['image_name'];
            
            ?>
            <div class="food-menu-box">
                <div class="food-menu-img">
            <?php
            if($image_name==""){
                echo "<div class='error'> Image is Not Available </div>";
            }
            else
            {
            ?>
             <img src="<?php echo SITEURL; ?>/images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

            <?php    

            }
            ?>

                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title; ?></h4>
                    <p class="food-price"><?php echo $price; ?></p>
                    <p class="food-detail">
                    <?php echo $description; ?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL; ?>/order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <?php

        }
    }
    else
    {
        echo "<div class='error'>FOOD NOT AVAILABLE </div>";
    }

        ?>

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');   ?>
    
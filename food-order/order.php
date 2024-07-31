
<?php include('partials-front/menu.php');   ?>

<?php
    //check whether the food id is set or not
     if(isset($_GET['food_id'])){
        
      $food_id=$_GET['food_id'];

      //get the details of selected foods
      $sql="SELECT * from tbl_food where id=$food_id";

      //execute query
      $res=mysqli_query($conn,$sql);

      //count rows
      $count=mysqli_num_rows($res);
      if($count==1){

            //get the data from db
            $row=mysqli_fetch_assoc($res);
            $title=$row['title'];
            $price=$row['price'];
            $image_name=$row['image_name'];
           

      }
      else
      {
        header('location:'.SITEURL);

      }

     }
     else
     {
         header('location:'.SITEURL);
     }

?>



    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                
                <?php
                if($image_name==""){
                    echo "<div class='error'>Image is Not Available </div>";
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

                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price"><?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
            //check the submit button is clicked or not
            if(isset($_POST['submit'])){
                //get all the details from the form
                $food=$_POST['food'];
                $price=$_POST['price'];
                $qty=$_POST['qty'];
                $total= $price * $qty;
                $order_date= date("Y-m-d h:i:sa");
                $status= "orderd";//like on going, deliverd, canceld
                $customer_name=$_POST['full-name'];
                $customer_contact=$_POST['contact'];
                $customer_email=$_POST['email'];
                $customer_address=$conn->real_escape_string($_POST['address']);

                //save the order in db
                //create sql to save the data
                $sql2="INSERT INTO tbl_order SET
                       food='$food',
                       price=$price,
                       qty='$qty',
                       total=$total,
                       order_date='$order_date',
                       status='$status',
                       customer_name='$customer_name',
                       customer_contact='$customer_contact',
                       customer_email='$customer_email',
                       customer_address='$customer_address' 
                       ";

                       //execute the query
                       $result=mysqli_query($conn,$sql2);
                    
                       //check query execute or not
                       if($result==true){
                        $_SESSION['order']="<div class='success1 text-center'>Food Ordered Successfull</div>";
                        header("location: ".SITEURL);
                       }
                       else{
                        $_SESSION['order']="<div class='error1 text-center'>Failed to Ordered Food</div>";
                        header("location: ".SITEURL);
                       }


            }
            else
            {

            }



            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    

    <?php include('partials-front/footer.php');   ?>
  
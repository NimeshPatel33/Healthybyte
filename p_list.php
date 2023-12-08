<?php


@include 'config.php';

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_id=$_POST['product_id'];
   $product_cat=$_POST['product_cat'];
   $uid=$_POST['userid'];
   $product_quantity = 1;

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity,p_id,cat,uid) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity','$product_id','$product_cat','$uid')");
      $message[] = 'product added to cart succesfully';
   }

}

?>
<?php

// include 'config.php';
// session_start();
// $user_id = $_SESSION['user_id'];

// if(!isset($user_id)){
//    header('location:log.php');
// };

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:log.php');
}

?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Home </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="assest/css/styleec.css">

    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
    <img src="assest/images/asd.jpg" alt="" width="50" height="50" style=" border-radius: 50%;">
      <span class="logo_name"> &nbsp;Healthybyte</span>
    </div>
    <ul class="nav-links">
        <li>
          <a href="home.php"  >
            <i class='bx bx-grid-alt'></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
        <a href="p_list.php" class="active" >
            <i class='bx bx-box' ></i>
            <span class="links_name">Product</span>
          </a>
        </li>
       
        <li>
          <a href="orders.php">
            <i class='bx bx-user' ></i>
            <span class="links_name">Orders</span>
          </a>
        </li>
      
        <li>
          <a href="history.php">
            <i class='bx bx-export' ></i>
            <span class="links_name">Order History</span>
          </a>
        </li>
        
        <li class="log_out">
          <a href="logout.php">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Healthybyte</span>
      </div>
      <?php
         
      // $select = mysqli_query($conn, "SELECT * FROM `formtest` WHERE id = '$user_id'") or die('query faileddd');
      // $fetch="";
      // if(mysqli_num_rows($select) > 0){
      //    $fetch = mysqli_fetch_assoc($select);
      // }
     
   ?> 
      <div class="profile-details">
        <a href="update_profile.php">
        <img src="assest/uploaded_img/user/<?php  ?>" alt="">
        <!-- echo $fetch['image']; -->
        <span class="admin_name"><?php  ?></span></a>
        <!-- echo $fetch['uname']; -->
        
      </div>
      
      <a href="cart.php"> <div class="profile-details">
      <?php
      include 'config.php';
      $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>

        <img src="assest/images/cart.png" alt="">
        <span class="admin_name">cart(<?php echo $row_count; ?>)</span>
        
      </div></a>
    </nav>
    <?php


if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>



<div class="container">

<section class="products">
<br>
<br>
<br>
<br>
<br>

   <h1 class="heading">Appetizers</h1>

   <div class="box-container">

      <?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE  cat LIKE '%appetizers%'");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
      <div class="box-container">

      <div class="box">
            <img src="assest/uploaded_img/<?php echo $fetch_product['image']; ?>" alt=""  width="100%" height="50%">
            <h3><?php echo $fetch_product['name']; ?></h3>
            <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <input type="hidden" name="product_id" value="<?php echo $fetch_product['id']; ?>">
            <input type="hidden" name="product_cat" value="<?php echo $fetch_product['cat']; ?>">
            <input type="hidden" name="userid" value="<?php echo $user_id; ?>">

            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
         </div>
      </form>
         </div>



      
      <?php
         };
      };
      ?>

   </div>

</section>

</div>





<div class="container">

<section class="products">

   <h1 class="heading">Salads&Bowls</h1>

   <div class="box-container">

      <?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE  cat LIKE '%salads&bowls%'");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
      <div class="box-container">

      <div class="box">
            <img src="assest/uploaded_img/<?php echo $fetch_product['image']; ?>" alt=""  width="100%" height="50%">
            <h3><?php echo $fetch_product['name']; ?></h3>
            <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <input type="hidden" name="product_id" value="<?php echo $fetch_product['id']; ?>">
            <input type="hidden" name="product_cat" value="<?php echo $fetch_product['cat']; ?>">
            <input type="hidden" name="userid" value="<?php echo $user_id; ?>">

            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
         </div>
      </form>
         </div>



      
      <?php
         };
      };
      ?>

   </div>

</section>

</div>




<div class="container">

<section class="products">

   <h1 class="heading">Main Courses</h1>

   <div class="box-container">

      <?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE  cat LIKE '%maincourses%'");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
      <div class="box-container">

      <div class="box">
            <img src="assest/uploaded_img/<?php echo $fetch_product['image']; ?>" alt=""  width="100%" height="50%">
            <h3><?php echo $fetch_product['name']; ?></h3>
            <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <input type="hidden" name="product_id" value="<?php echo $fetch_product['id']; ?>">
            <input type="hidden" name="product_cat" value="<?php echo $fetch_product['cat']; ?>">
            <input type="hidden" name="userid" value="<?php echo $user_id; ?>">

            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
         </div>
      </form>
         </div>



      
      <?php
         };
      };
      ?>

   </div>

</section>

</div>



<div class="container">

<section class="products">

   <h1 class="heading">Sides</h1>

   <div class="box-container">

      <?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE  cat LIKE '%sides%'");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
      <div class="box-container">

      <div class="box">
            <img src="assest/uploaded_img/<?php echo $fetch_product['image']; ?>" alt=""  width="100%" height="50%">
            <h3><?php echo $fetch_product['name']; ?></h3>
            <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <input type="hidden" name="product_id" value="<?php echo $fetch_product['id']; ?>">
            <input type="hidden" name="product_cat" value="<?php echo $fetch_product['cat']; ?>">
            <input type="hidden" name="userid" value="<?php echo $user_id; ?>">

            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
         </div>
      </form>
         </div>



      
      <?php
         };
      };
      ?>

   </div>

</section>

</div>





<div class="container">

<section class="products">

   <h1 class="heading">Desserts</h1>

   <div class="box-container">

      <?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE  cat LIKE '%desserts%'");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
      <div class="box-container">

      <div class="box">
            <img src="assest/uploaded_img/<?php echo $fetch_product['image']; ?>" alt=""  width="100%" height="50%">
            <h3><?php echo $fetch_product['name']; ?></h3>
            <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <input type="hidden" name="product_id" value="<?php echo $fetch_product['id']; ?>">
            <input type="hidden" name="product_cat" value="<?php echo $fetch_product['cat']; ?>">
            <input type="hidden" name="userid" value="<?php echo $user_id; ?>">

            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
         </div>
      </form>
         </div>



      
      <?php
         };
      };
      ?>

   </div>

</section>

</div>
</section>

  <script>
   let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}
 </script>

</body>
</html>


<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:log.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:log.php');
}
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM `products` WHERE id = $delete_id ") or die('query failed');
   if($delete_query){
      header('location:ad.php');
      $message[] = 'product has been deleted';
   }else{
      header('location:ad.php');
      $message[] = 'product could not be deleted';
   };
};

if(isset($_POST['update_product'])){
   $update_p_id = $_POST['update_p_id'];
   $update_p_name = $_POST['update_p_name'];
   $update_p_price = $_POST['update_p_price'];
   $update_p_image = $_FILES['update_p_image']['name'];
   $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
   $update_p_image_folder = 'assest/uploaded_img/'.$update_p_image;

   $update_query = mysqli_query($conn, "UPDATE `products` SET name = '$update_p_name', price = '$update_p_price', image = '$update_p_image' WHERE id = '$update_p_id'");

   if($update_query){
      move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
      $message[] = 'product updated succesfully';
      header('location:ad.php');
   }else{
      $message[] = 'product could not be updated';
      header('location:ad.php');
   }

}


?>


<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Admin Panel </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="assest/css/styleec.css">

    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">Healthybyte</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="index.php" >
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="ad.php"  class="active">
            <i class='bx bx-box' ></i>
            <span class="links_name">Product</span>
          </a>
        </li>
        <li>
          <a href="adsea.php">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Order list</span>
          </a>
        </li>
        <li>
          <a href="uad.php">
            <i class='bx bx-user' ></i>
            <span class="links_name">Users</span>
          </a>
        </li>
        <li>
          <a href="admin.php">
            <i class='bx bx-message' ></i>
            <span class="links_name">Add Products</span>
          </a>
        </li>
        <li>
          <a href="ordertak.php" >
            <i class='bx bx-import' ></i>
            <span class="links_name">Order Table</span>
          </a>
        </li>
        <li>
          <a href="doneorders.php">
            <i class='bx bx-export' ></i>
            <span class="links_name">Prepered Orders</span>
          </a>
        </li>
        <li class="log_out">
          <a href="#">
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
        <span class="dashboard">Dashboard</span>
      </div>
      <?php
         
      $select = mysqli_query($conn, "SELECT * FROM `formtest` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
     
   ?> 
      <div class="profile-details">
        
        <img src="assest/uploaded_img/user/<?php echo $fetch['image']; ?>" alt="">
        <span class="admin_name"><?php echo $fetch['uname']; ?></span>
        
      </div>
    </nav>
   

    <div class="container">

<section class="products">

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
            <img src="assest/uploaded_img/<?php echo $fetch_product['image']; ?>" alt="" width="100%" height="50%">
            <h3><?php echo $fetch_product['name']; ?></h3>
            <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <a href="ad.php?delete=<?php echo $fetch_product['id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
               <a href="ad.php?edit=<?php echo $fetch_product['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
            <!-- <input type="submit" class="btn" value="add to cart" name="add_to_cart"> -->
         </div>
      </form>
         </div>



      
      <?php
         };
      };
      ?>

<section class="edit-form-container">

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <img src="assest/uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
      <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['name']; ?>">
      <input type="number" min="0" class="box" required name="update_p_price" value="<?php echo $fetch_edit['price']; ?>">
      <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
      <input type="submit" value="update the prodcut" name="update_product" class="btn">

      <!-- <input type="reset" value="cancel" id="close-edit" class="option-btn"> -->
      <br>
      <a href="ad.php" class="delete-btn">Cancel</a>

   </form>

   <?php
            };
         };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>

</section>
               
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
            <img src="assest/uploaded_img/<?php echo $fetch_product['image']; ?>" alt="" width="100%" height="50%">
            <h3><?php echo $fetch_product['name']; ?></h3>
            <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <a href="ad.php?delete=<?php echo $fetch_product['id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
               <a href="ad.php?edit=<?php echo $fetch_product['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
            <!-- <input type="submit" class="btn" value="add to cart" name="add_to_cart"> -->
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
            <img src="assest/uploaded_img/<?php echo $fetch_product['image']; ?>" alt="" width="100%" height="50%">
            <h3><?php echo $fetch_product['name']; ?></h3>
            <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <a href="ad.php?delete=<?php echo $fetch_product['id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
               <a href="ad.php?edit=<?php echo $fetch_product['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
            <!-- <input type="submit" class="btn" value="add to cart" name="add_to_cart"> -->
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
            <img src="assest/uploaded_img/<?php echo $fetch_product['image']; ?>" alt="" width="100%" height="50%">
            <h3><?php echo $fetch_product['name']; ?></h3>
            <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <a href="ad.php?delete=<?php echo $fetch_product['id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
               <a href="ad.php?edit=<?php echo $fetch_product['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
            <!-- <input type="submit" class="btn" value="add to cart" name="add_to_cart"> -->
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
            <img src="assest/uploaded_img/<?php echo $fetch_product['image']; ?>" alt="" width="100%" height="50%">
            <h3><?php echo $fetch_product['name']; ?></h3>
            <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <a href="ad.php?delete=<?php echo $fetch_product['id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
               <a href="ad.php?edit=<?php echo $fetch_product['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
            <!-- <input type="submit" class="btn" value="add to cart" name="add_to_cart"> -->
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

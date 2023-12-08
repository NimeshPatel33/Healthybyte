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

?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Admin Panel </title>
    <link rel="stylesheet" href="style.css">
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
          <a href="index.php" class="active">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="ad.php">
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
    <?php
$user = mysqli_query($conn, "SELECT COUNT(*) AS ua FROM `order` ");
         if(mysqli_num_rows($user) > 0){
            while($row = mysqli_fetch_assoc($user)){
      ?>
    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Order</div>
            <div class="number"><?php echo $row['ua']; ?></div>
         
          </div>

          <i class='bx bx-cart-alt cart'></i>
        </div>
        <?php
 };    
}
?>
<?php
$t=0;
$user = mysqli_query($conn, "SELECT total_products FROM `order`");
         if(mysqli_num_rows($user) > 0){
            while($row = mysqli_fetch_assoc($user))
            {
                $t += $row['total_products'];
              };
      ?>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Sales</div>
            <div class="number"><?php echo "$t"; ?></div>
          
          </div>
          <i class='bx bxs-cart-add cart two' ></i>
        </div>
        <?php 
           
            }
            ?>
    <?php
    $a=0;
   
$user = mysqli_query($conn, "SELECT SUM(total_price) FROM `order`");
         if(mysqli_num_rows($user) > 0){
            while($row = mysqli_fetch_assoc($user)){ 
              
                $a =+ $row['SUM(total_price)']; 
              };    
              $percentage = $a;
              $totalWidth = 36;
              
              $new_width = ($percentage / 100) * $totalWidth;
              
      ?>

        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Income</div>
            <div class="number">$<?php echo "$a"; ?></div>
         
          </div>
          <i class='bx bx-cart cart three' ></i>
        </div>
     
        


        <div class="box">
          <br>
          <div class="right-side">
            <div class="box-topic">Total Profit</div>
            <div class="number">$<?php echo "$new_width"; ?></div>
         
          </div>
          <i class='bx bxs-cart-download cart four' ></i>
        </div>
      </div>

      
      <?php
   }
    ?>

 
      <div class="sales-boxes">
        <div class="recent-sales box">
          <div class="title">Recent Sales</div>
          <div class="sales-details">

     
          <ul class="details">
              <li class="topic">Date</li>              <?php

$user = mysqli_query($conn, "SELECT * FROM `order`  ORDER BY id DESC LIMIT 10");
if(mysqli_num_rows($user) > 0){
   while($row = mysqli_fetch_assoc($user)){   
     ?>
              <li><a href="#"><?php echo $row['order_date']; ?></a></li>
              <?php
 
};
       };
    ?>           
            </ul>

            <ul class="details">
            <li class="topic">Customer</li>
            <?php

$user = mysqli_query($conn, "SELECT * FROM `order`  ORDER BY id DESC LIMIT 10");
if(mysqli_num_rows($user) > 0){
   while($row = mysqli_fetch_assoc($user)){   
     ?>
            <li><a href="#"><?php echo $row['name']; ?></a></li>
         
             <?php
 
};
       };
    ?>   
          </ul>
          <ul class="details">
            <li class="topic">Status</li>
            <?php

$user = mysqli_query($conn, "SELECT * FROM `order` ORDER BY id DESC LIMIT 10");
if(mysqli_num_rows($user) > 0){
   while($row = mysqli_fetch_assoc($user)){   
     ?>
            <li><a href="#"><?php echo $row['status']; ?></a></li>
         
             <?php
 
};
       };
    ?>   
          </ul>
          <ul class="details">
            <li class="topic">Total</li>
            <?php

$user = mysqli_query($conn, "SELECT * FROM `order` ORDER BY id DESC LIMIT 10");
if(mysqli_num_rows($user) > 0){
   while($row = mysqli_fetch_assoc($user)){   
     ?>
            <li><a href="#">$<?php echo $row['total_price']; ?></a></li>
         
             <?php
 
};
       };
    ?>   
          </ul>
          </div>
        </div>
       
       
        <div class="top-sales box">
          <div class="title">Top Seling Product</div>
          <ul class="top-sales-details">
          <?php

$user = mysqli_query($conn, "SELECT * FROM `products` LIMIT 8");
if(mysqli_num_rows($user) > 0){
   while($row = mysqli_fetch_assoc($user)){   
     ?>
            <li>
            <a href="#">
              <img src="assest/uploaded_img/<?php echo $row['image']; ?>" alt="">
              <span class="product"><?php echo $row['name']; ?></span>
            </a>
            <span class="price">$<?php echo $row['price']; ?></span>
          </li>
          <?php
 
};
       };
    ?> 
          </ul>
        </div>
      </div>
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

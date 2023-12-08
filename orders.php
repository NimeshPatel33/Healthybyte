
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
};

if(isset($_GET['cancel'])){
  $cancel_id = $_GET['cancel'];
  $cancel_query = mysqli_query($conn, "UPDATE `order` SET status='cancel' WHERE id =$cancel_id") or die('query failed');
  if($cancel_query){
     header('location:orders.php');
     $message[] = 'Oreder has been canceled';
  }else{
     header('location:orders.php');
     $message[] = 'Order could not be canceled';
  };
};


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
          <a href="home.php" >
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="home.php"  >
            <i class='bx bx-box' ></i>
            <span class="links_name">Product</span>
          </a>
        </li>
       
        <li>
          <a href="orders.php" class="active">
            <i class='bx bx-user' ></i>
            <span class="links_name">Orders</span>
          </a>
        </li>
      
        <li>
          <a href="history.php" >
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
         
      $select = mysqli_query($conn, "SELECT * FROM `formtest` WHERE id = '$user_id'") or die('query failed');
      $fetch="";
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
     
   ?> 
      <div class="profile-details">
        <a href="update_profile.php">
        <img src="assest/uploaded_img/user/<?php echo $fetch['image']; ?>" alt="">
        <span class="admin_name"><?php echo $fetch['uname']; ?></span></a>
        
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
  
<section class="display-product-table">
<h1 class="heading">Approved Orders</h1>
   <table>

      <thead>
      
         <th>product name</th>
         <th>product price</th>
         <th>product quantity</th>
         <th>Order Date</th>
         <th>Food Item</th>



         

         <th>action</th>
      </thead>

      <tbody>
         <?php   
  
         $v=$fetch['uname'];

            $q = "SELECT * FROM `order` WHERE name='$v' AND status='disapprove'";
            $qr = mysqli_query($conn, $q);
            
          
         ?>

         <tr>
         <?php
        if(mysqli_num_rows($qr) > 0){
            while($row = mysqli_fetch_array($qr)){
               $b= substr($row['pr_name'],0,-2);
               $a=explode (",",$b );
      ?>
            <td><?php echo $row['name']; ?></td>
            <td>$<?php echo $row['total_price']; ?>/-</td>
            <td><?php echo $row['total_products']; ?></td>
            <td><?php echo $row['order_date']; ?></td>
            <td><?php for($i = 0; $i < count($a); $i++){ echo "<ul'><li>".$a[$i]."</li></ul>";} ?></td>

           
            <td>
               <a href="orders.php?cancel=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to cancel this?');"> <i class="fas fa-trash"></i> Cancel </a>
           
            </td>
         </tr>
         <?php
            };    
            }else{
               echo "<div class='empty'>Your order has not been accepted yet</div>";
            };
        
         ?>

         
      </tbody>
   </table>

   
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

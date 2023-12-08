




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
    <title> update profile </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="assest/css/styleec.css">
    <link rel="stylesheet" href="assest/css/c.css">

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
          <a href="ad.php"  >
            <i class='bx bx-box' ></i>
            <span class="links_name">Product</span>
          </a>
        </li>
       
        <li>
          <a href="hom.php">
            <i class='bx bx-user' ></i>
            <span class="links_name">Users</span>
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
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
     
   ?> 
      <div class="profile-details">
        
        <img src="assest/uploaded_img/user/<?php echo $fetch['image']; ?>" alt="">
        <span class="admin_name"><?php echo $fetch['uname']; ?></span>
        
      </div>

      <div class="profile-details">
        
        <img src="assest/images/cart.png" alt="">
        <span class="admin_name">cart</span>
        
      </div>
    </nav>
    
    <body>
  
<div class="container">

   <div class="profile">
      <?php
   
         $select = mysqli_query($conn, "SELECT * FROM `formtest` WHERE id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['image'] == ''){
            echo '<img src="assest/uploaded_img/asd.jpg">';
         }else{
            echo '<img src="assest/uploaded_img/user/'.$fetch['image'].'">';
         }
      ?>
      <h3><?php echo $fetch['uname']; ?></h3>
      <a href="update_profile.php" class="btn">update profile</a>
<br>
      <a href="hom.php?logout=<?php echo $user_id; ?>" class="delete-btn">logout</a>
      <br>
      <p>new <a href="log.php">login</a> or <a href="register.php">register</a></p>
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

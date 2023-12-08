
<?php

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
<?php

$servername = "localhost";
$uname = "root";
$pass = "";
$db = "db1";

$con=mysqli_connect($servername,$uname,$pass,$db);

if(isset($_GET['delete'])){
  $delete_id = $_GET['delete'];
  $delete_query = mysqli_query($con, "DELETE FROM `order` WHERE id = $delete_id ") or die('query failed');
  if($delete_query){
     header('location:adsea.php');
     $message[] = 'Oreder has been deleted';
  }else{
     header('location:adsea.php');
     $message[] = 'Order could not be deleted';
  };
};

?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Admin Panel </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="assest/css/styleec.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <style>
  
        .search {
          width: 100%;
          position: relative;
          display: flex;
          color:#ff3838;
        }
        
        .searchTerm {
          width: 100%;
          border: 2px solid #ff3838;
          border-right: none;
          padding: 5px;
          height: 40px;
          border-radius: 5px 0 0 5px;
          outline: none;
          color: #ff3838;
          font-size: 18px;
          font-weight: bold;
          background:transparent;
        }
        
        .searchTerm:focus{
          color: #ff3838;
        }
        
        .searchButton {
          width: 38px;
          height: 40px;
          border: 2px solid #ff3838;
          background:transparent;
        
          text-align: center;
          color: #ff3838;
          border-radius: 0 5px 5px 0;
          cursor: pointer;
          font-size: 20px;
        }
        
        /*Resize the wrap to see the search bar change!*/
        .wrap{
          width: 60%;
          position: absolute;
          top: 18%;
          left: 50%;
          transform: translate(-50%, -50%);
        }

        input[type="date"]::-webkit-calendar-picker-indicator {
    background: transparent;
    bottom: 0;
    color: transparent;
    cursor: pointer;
    height: auto;
    left: 0;
    position: absolute;
    right: 0;
    top: 0;
    width: auto;
}

      
            </style>
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
          <a href="ad.php"  >
            <i class='bx bx-box' ></i>
            <span class="links_name">Product</span>
          </a>
        </li>
        <li>
          <a href="adsea.php" class="active">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Order list</span>
          </a>
        </li>
        <li>
          <a href="uad.php" >
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
         
      $select = mysqli_query($con, "SELECT * FROM `formtest` WHERE id = '$user_id'") or die('query failed');
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

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<form action="" method="POST">
<div class="wrap">
   <div class="search">
      <input type="text" class="searchTerm" placeholder="Which customer order do you want to see?" name="search" >
      <input type="date" class="searchTerm" name="date" id="date">
      <button type="submit" name="submit" class="searchButton">
        <i class="fas fa-search"></i>
     </button>
     
     
     
    </div>
</div>

</form>

<br>
<br>

<br>
<br>
<br>
<?php
         if(isset($_POST['submit'])){
            
            if(isset($_POST['search']) && isset($_POST['date'])){

            

            $ss = $_POST['search'];
            $dd=$_POST['date'];
           
           
            $q = "SELECT * FROM `order`  WHERE name = '$ss' and order_date = '$dd'";
            $qr = mysqli_query($con, $q);
            }
            elseif(isset($_POST['search']) || isset($_POST['date'])){
              $ss = $_POST['search'];
              $dd=$_POST['date'];
               
               
                $q = "SELECT * FROM `order`  WHERE name = '$ss' or order_date = '$dd'";
                $qr = mysqli_query($con, $q);}
         ?>

<div class="container">
<section class="display-product-table">
    <br>
    <br>
    <br>
    <br>
    <br>
<h1 class="heading">Order Details</h1>
   <table>

      <thead>
      
      <th>Food name</th>
         <th>Food price</th>
         <th>Food quantity</th>
         <th>Food Items</th>
         <th>Order Date and Time</th>


         

         <!-- <th>action</th> -->
      </thead>

      <tbody>
       
         <tr>
      <?php
        if(mysqli_num_rows($qr) > 0){
            while($row = mysqli_fetch_array($qr)){
      ?>
            <td><?php echo $row['name']; ?></td>
            <td>$<?php echo $row['total_price']; ?>/-</td>
            <td><?php echo $row['total_products']; ?></td>
            <td><?php echo $row['pr_name']; ?></td>
            <td><?php echo $row['order_date']; ?></td>
           
            
         </tr>
         <?php
            };    
            }
            else{
               echo "<div class='empty'>Did Not Order Anything </div>";
            };
        }
    
         ?>



         
      </tbody>
   </table>

</section>


<!-- ///////////////////////////////////////////////////////////////////////////////////// -->
<form method="POST" action=""><input type="submit"  class="btn" name="see" value="If You Want To See The Entire Order, Click Here!"></input></form>

<?php 
  if(isset($_POST['see']))
{

?>

<div class="container">
<section class="display-product-table">
<h1 class="heading">Order Details</h1>
   <table>

      <thead>
      
         <th>Food name</th>
         <th>Food price</th>
         <th>Food quantity</th>
         <th>Food Items</th>
         <th>Order Date and Time</th>

         

         <th>action</th>
      </thead>

      <tbody>
      <?php
         if(isset($_POST['see'])){
           
           
           
            $q = "SELECT * FROM `order`";
            $qr = mysqli_query($con, $q);
            
          
         ?>

         <tr>
      <?php
        if(mysqli_num_rows($qr) > 0){
            while($row = mysqli_fetch_array($qr)){
      ?>
            <td><?php echo $row['name']; ?></td>
            <td>$<?php echo $row['total_price']; ?>/-</td>
            <td><?php echo $row['total_products']; ?></td>
            <td><?php echo $row['pr_name']; ?></td>

            <td><?php echo $row['order_date']; ?></td>
           
            <td>
               <a href="adsea.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
               
            </td>
         </tr>
         <?php
            };    
            }
            else{
               echo "<div class='empty'>Did Not Order Anything </div>";
            };
        }
    
         ?>

         
      </tbody>
   </table>

</section>
<?php } ?>
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

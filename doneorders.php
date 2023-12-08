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


@include 'config.php';



$userprofile = $_SESSION['admin_name'];



if($userprofile == true)
{

}
else
{
    echo "<script>window.location.href='log.php'</script>";
}



$servername = "localhost";
$uname = "root";
$pass = "";
$db = "db1";

$con=mysqli_connect($servername,$uname,$pass,$db);



if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($conn, "DELETE FROM `order` WHERE id = $delete_id ") or die('query failed');
    if($delete_query){
       header('location:ordertak.php');
       $message[] = 'Oreder has been deleted';
    }else{
       header('location:ordertak.php');
       $message[] = 'Order could not be deleted';
    };
 };



 if(isset($_GET['apprrove'])){
    $approve_id = $_GET['apprrove'];

    // $approve_query = mysqli_query($conn, "DELETE status FROM `order` WHERE id = $approve_id") or die('query failed');
    $approve_query = mysqli_query($conn, "UPDATE `order` SET status='approve' WHERE id =$approve_id") or die('query failed');

    if($approve_query){
        $row['status']="approve";
       header('location:ordertak.php');
       $message[] = 'Oreder has been deleted';
    }else{
       header('location:ordertak.php');
       $message[] = 'Order could not be deleted';
    };
 };


 if(isset($_GET['report'])){
   
    $q = "SELECT * FROM `order` WHERE `status`='done'";
    $qr = mysqli_query($con, $q);
   
    if(mysqli_num_rows($qr)>0){
 
      $html='<table border="1">';
      $html.='<tr><td>User Name</td><td>Food Name</td><td>Product Quantity</td><td>Total Ammount</td><td>Order Date</td></tr>';
      while($row=mysqli_fetch_assoc($qr))
      {
          $html.='<tr><td>'.$row['name'].'</td><td>'.$row['pr_name'].'</td><td>'.$row['total_products'].'</td><td>'.$row['total_price'].'</td><td>'.$row['order_date'].'</td></tr>';
      }
      $html.='</table>';
    }
    echo $html;
    require_once __DIR__ . '/vendor/autoload.php';

    $mpdf=new \Mpdf\MPDF();
    $mpdf->WriteHTML($html);
    $file='report/'.time().'.pdf';
    $mpdf->output($file,'D');
    

 };


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="assest/css/styleec.css">
   <link rel="stylesheet" href="style.css">


</head>

    <style>
            body {
   background-image: url("assest/images/home-bg.jpg");
 }
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
          width: 30%;
          position: absolute;
          top: 15%;
          left: 50%;
          transform: translate(-50%, -50%);
        }

ul  {
  type: upper-roman;
  margin: 41;
  padding: 0;
}

            </style>
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
          <a href="ordertak.php">
            <i class='bx bx-import' ></i>
            <span class="links_name">Order Table</span>
          </a>
        </li>
        <li>
          <a href="doneorders.php" class="active">
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

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>
<br>
<br>

<br>
<br>
<br>

<div class="container">
<section class="display-product-table">
<h1 class="heading">Order Prepered</h1>
   <table>

      <thead>
      
         <th>User Name</th>
         <th>Product Price</th>
         <th>Product Quantity</th>
         <th>Order Date and Time</th>
         <th>Food Item</th>



         

      </thead>

      <tbody>
         <?php   
            $q = "SELECT * FROM `order` WHERE `status`='done'";
            $qr = mysqli_query($con, $q);
            
          
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

           
        
         </tr>
         <?php
            };    
            }else{
               echo "<div class='empty'>Did Not Order Anything </div>";
            };
        
         ?>

         
      </tbody>
   </table>

</section>

</div>
<a href="doneorders.php?report" class="aa-btn"> <i class="fas fa-edit"></i> Genrate Report </a>
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

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
  $delete_query = mysqli_query($conn, "DELETE FROM `formtest` WHERE id = $delete_id ") or die('query failed');
  if($delete_query){
     header('location:uad.php');
     $message[] = 'User has been deleted';
  }else{
     header('location:uad.php');
     $message[] = 'User could not be deleted';
  };

}
if(isset($_POST['update_product'])){
  $update_p_id = $_POST['update_p_id'];
  $update_name = $_POST['update_name'];
  $update_email = $_POST['update_email'];
  $update_image = $_FILES['update_image']['name'];
  $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
  $update_image_folder = 'assest/uploaded_img/user/'.$update_image;

  $update_query = mysqli_query($conn, "UPDATE `formtest` SET uname = '$update_name', email = '$update_email', image = '$update_image' WHERE id = '$update_p_id'");

  if($update_query){
     move_uploaded_file($update_image_tmp_name, $update_image_folder);
     $message[] = 'User updated succesfully';
     header('location:uad.php');
  }else{
     $message[] = 'User could not be updated';
     header('location:uad.php');
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
          <a href="ad.php"  >
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
          <a href="uad.php" class="active">
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
          <a href="doneorders.php" >
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
   


    <section class="display-product-table">
<h1 class="heading">All User Details</h1>
   <table>

      <thead>
         <th>User Image</th>
         <th>User Name</th>
         <th>User Email ID</th>
         <th>User Type</th>
         <th>action</th>
      </thead>

      <tbody>
         <?php
         
            $select_products = mysqli_query($conn, "SELECT * FROM `formtest`");
            if(mysqli_num_rows($select_products) > 0){
               while($row = mysqli_fetch_assoc($select_products)){
         ?>

         <tr>
            <td><img src="assest/uploaded_img/user/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['uname']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['usertype']; ?></td>

            <td>
               <a href="uad.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
               <a href="uad.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
            </td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>No User In Site</div>";
            };
         ?>
      </tbody>
   </table>

</section>

<section class="edit-form-container">

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($conn, "SELECT * FROM `formtest` WHERE id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <img src="assest/uploaded_img/user/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
      <input type="text" class="box" required name="update_name" value="<?php echo $fetch_edit['uname']; ?>">
      <input type="text" min="0" class="box" required name="update_email" value="<?php echo $fetch_edit['email']; ?>">
      <input type="file" class="box" required name="update_image" accept="image/png, image/jpg, image/jpeg">
      <input type="submit" value="update the User Details" name="update_product" class="btn">
      <!-- <input type="reset" value="cancel" name="cancel"  class="option-btn"> -->
      <br>
      <a href="uad.php" class="delete-btn">Cancel</a>
   </form>

   <?php
            };
         };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>

</section>






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

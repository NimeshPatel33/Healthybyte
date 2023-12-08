


<?php

@include 'config.php';


if(isset($_POST['order_btn'])){

   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $flat = $_POST['flat'];
   $street = $_POST['street'];
   $city = $_POST['city'];
  
   $pin_code = $_POST['pin_code'];

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
   $price_total = 0;
   $total_product=0;
   $ppname="";
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';
         $product_price = ($product_item['price'] * $product_item['quantity']);
         $price_total += $product_price;
         $total_product += $product_item['quantity'];
         $ppname.= $product_item['name']."(".$product_item['quantity'].")"." , ";
      };

   };
  

   $detail_query = mysqli_query($conn, "INSERT INTO `order`(name, number, email, method, flat, street, city,pin_code, total_products, total_price,pr_name) VALUES('$name','$number','$email','$method','$flat','$street','$city','$pin_code','$total_product','$price_total','$ppname')") or die('query failed');

   if($cart_query && $detail_query){
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
      
      <form action='del.php' method='post'>
         <h3>thank you for shopping!</h3>
         <div class='order-detail'>
            <span> Food Item : ".$total_product."</span>
            <span> total : $".$price_total."/-  </span>
         </div>
         <div class='customer-details'>
            <p> your name : <span>".$name."</span> </p>
            <p> your number : <span>".$number."</span> </p>
            <p> your email : <span>".$email."</span> </p>
            <p> your address : <span>".$flat.", ".$street.", ".$city.", ".$pin_code."</span> </p>
            <p> your payment mode : <span>".$method."</span> </p>
            <p>(*pay when product arrives*)</p>
         </div>
         <input type='submit' value='continue shopping' name='pbtn' class='btn'>
           
            </form>

         </div>
      </div>
      ";

     
   }

}

?>

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
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> CHECKOUT </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="assest/css/styleec.css">
    <!-- <link rel="stylesheet" href="assest/css/c.css"> -->

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
    
    


<div class="container">

<section class="checkout-form">

   <h1 class="heading">complete your order</h1>

   <form action="" method="post">

   <div class="display-order">
      <?php
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         $total = 0;
         $grand_total = 0;
         $sd="";
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total = $total += $total_price;
      ?>
      <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
      <?php
         }
      }else{
         echo "<div class='display-order'><span>your cart is empty!</span></div>";
      }
      ?>



      <span class="grand-total"> grand total : $<?= $grand_total; ?>/- </span>
   </div>



   <?php
   
   
    
      $edit_query = mysqli_query($conn, "SELECT * FROM formtest WHERE id = '$user_id'");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>



      <div class="flex">
         <div class="inputBox">
            <span>your name</span>
            <input type="text" placeholder="enter your name" name="name" value="<?php echo $fetch_edit['uname']; ?>" required>
         </div>
         <div class="inputBox">
            <span>your number</span>
            <input type="number" placeholder="enter your number" name="number" value="<?php echo $fetch_edit['phone']; ?>"required>
         </div>
         <div class="inputBox">
            <span>your email</span>
            <input type="email" placeholder="enter your email" name="email" value="<?php echo $fetch_edit['email']; ?>" required>
         </div>
        
         <div class="inputBox">
            <span>payment method</span>
            <select name="method">
               <option value="cash on delivery" selected>cash on delivery</option>
               <option value="credit cart">credit/debit card</option>
               <option value="paypal">paypal</option>
            </select>
         </div>
         

         <div class="inputBox">
            <span>address line 1</span>
            <input type="text" placeholder="e.g. flat no." name="flat"  value="<?php echo $fetch_edit['flat']; ?>"  required>
         </div>
         <div class="inputBox">
            <span>address line 2</span>
            <input type="text" placeholder="e.g. street name" name="street" value="<?php echo $fetch_edit['street']; ?>" required>
         </div>
         <div class="inputBox">
            <span>city</span>
            <input type="text" placeholder="e.g.jersey city" name="city" value="<?php echo $fetch_edit['city']; ?>"  required>
         </div>
        
         <div class="inputBox">
            <span>zip code</span>
            <input type="text" placeholder="e.g. 123456" name="zip_code" value="<?php echo $fetch_edit['pincode']; ?>"  required>
         </div>
       
      </div>
      <input type="submit" value="order now" name="order_btn" class="btn">
   </form>
   <?php
   
   
  
};
};
  
?>
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










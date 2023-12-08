<?php

@include 'config.php';

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
      $message[] = 'product added to cart succesfully';
      echo "<script>window.location.href='home.php'</script>";
   }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- font awesome cdn link  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<!-- custom css file link  -->
        <link rel="stylesheet" href="assest/css/style.css">
    <title>Mainpage of Healthybyte</title>
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
  width: 30%;
  position: absolute;
  top: 85%;
  left: 24%;
  transform: translate(-50%, -50%);
}
    </style>
</head>
<body>

<section class="home" id="home">

<div class="content">
<h3>Nourish Your Body with Delicious Wellness</h3>
    <p>Discover the joy of eating well without compromising on taste. Whether you're a seasoned health enthusiast or just beginning your wellness journey, HealthyByte is here to make nutritious dining an enjoyable and fulfilling experience for everyone.</p>
    <h4> Today's Chef Special: </h4>
    <p>Nourish & Thrive Trio
<br>Appetizer: Green Goddess Hummus Platter
<br>Starter: Quinoa-Stuffed Bell Peppers
<br>Main Course: Herb-Grilled Chicken with Citrus Glaze</p>
    <!-- <a href="#" class="btn">order now</a> -->
    <form method="post" action="">
               <input type="hidden" name="product_name" value="Healthybyte Special Coffe">
            <input type="hidden" name="product_price" value="5.00">
            <input type="hidden" name="product_image" value="coff.png"> 
            <a href="products.php" class="btn" name="add_to_cart" value="Order Now">Order Now</a></form>
               <!-- <input type="submit"  class="btn" name="add_to_cart" value="Order Now"></input></form> -->
</div>

<div class="image">
    <img src="assest/images/coff.png" alt="" >
</div>
<form action="food_search.php" method="post">
<div class="wrap">
   <div class="search">
      <input type="text" class="searchTerm" placeholder="What are you looking for?" name="search" required >
      <button type="submit" class="searchButton">
        <i class="fas fa-search"></i>
     </button>
   </div>
</div>
</form>

</section>

</header>
<script src="assest/js/script.js"></script>
</body>
</html>
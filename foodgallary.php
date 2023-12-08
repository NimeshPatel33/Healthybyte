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
    <title>food gallery</title>
</head>
<body>

<section class="gallery" id="gallery">

    <h1 class="heading"> our food <span> gallery </span> </h1>

    <div class="box-container">

        <div class="box">
            <img src="assest/images/g-1.jpg" alt="">
            <div class="content">
            
                <h3>tasty food</h3>
                <p>Lorem ipsum  sit, amet consectetur adipisicing elit. Deleniti, ipsum.</p>
               <form method="post" action="">
               <input type="hidden" name="product_name" value="Did Special Salads&Bowls">
            <input type="hidden" name="product_price" value="220">
            <input type="hidden" name="product_image" value="g-1.jpg"> 
               <input type="submit"  class="btn" name="add_to_cart" value="ordern now"></input></form>
            </div>
        </div>
        <div class="box">
            <img src="assest/images/g-2.jpg" alt="">
            <div class="content">
                <h3>tasty food</h3>
                <p>Lorem ipsum  sit, amet consectetur adipisicing elit. Deleniti, ipsum.</p>
                <form method="post" action="">
               <input type="hidden" name="product_name" value="Did Special Sandwich">
            <input type="hidden" name="product_price" value="180">
            <input type="hidden" name="product_image" value="g-2.jpg"> 
               <input type="submit"  class="btn" name="add_to_cart" value="ordern now"></input></form>
            </div>
        </div>
        <div class="box">
            <img src="assest/images/g-3.jpg" alt="">
            <div class="content">
                <h3>tasty food</h3>
                <p>Lorem ipsum  sit, amet consectetur adipisicing elit. Deleniti, ipsum.</p>
                <form method="post" action="">
               <input type="hidden" name="product_name" value="Did Special Wrap">
            <input type="hidden" name="product_price" value="250">
            <input type="hidden" name="product_image" value="g-3.jpg"> 
               <input type="submit"  class="btn" name="add_to_cart" value="ordern now"></input></form>
            </div>
        </div>
        <div class="box">
            <img src="assest/images/g-4.jpg" alt="">
            <div class="content">
                <h3>tasty food</h3>
                <p>Lorem ipsum  sit, amet consectetur adipisicing elit. Deleniti, ipsum.</p>
                <form method="post" action="">
               <input type="hidden" name="product_name" value="Did Special Main Courses">
            <input type="hidden" name="product_price" value="360">
            <input type="hidden" name="product_image" value="g-4.jpg"> 
               <input type="submit"  class="btn" name="add_to_cart" value="ordern now"></input></form>
            </div>
        </div>
        <div class="box">
            <img src="assest/images/g-5.jpg" alt="">
            <div class="content">
                <h3>tasty food</h3>
                <p>Lorem ipsum  sit, amet consectetur adipisicing elit. Deleniti, ipsum.</p>
                <form method="post" action="">
               <input type="hidden" name="product_name" value="Did Special Choclate">
            <input type="hidden" name="product_price" value="190">
            <input type="hidden" name="product_image" value="g-5.jpg"> 
               <input type="submit"  class="btn" name="add_to_cart" value="ordern now"></input></form>
            </div>
        </div>
        <div class="box">
            <img src="assest/images/tp.jpg" alt="">
            <div class="content">
                <h3>tasty food</h3>
                <p>Lorem ipsum  sit, amet consectetur adipisicing elit. Deleniti, ipsum.</p>
                <form method="post" action="">
               <input type="hidden" name="product_name" value="Did Special Sides">
            <input type="hidden" name="product_price" value="350">
            <input type="hidden" name="product_image" value="tp.jpg"> 
               <input type="submit"  class="btn" name="add_to_cart" value="ordern now"></input></form>
            </div>
        </div>
        <div class="box">
            <img src="assest/images/ccp.jpg" alt="">
            <div class="content">
                <h3>tasty food</h3>
                <p>Lorem ipsum  sit, amet consectetur adipisicing elit. Deleniti, ipsum.</p>
                <form method="post" action="">
               <input type="hidden" name="product_name" value="Did Special Appetizers">
            <input type="hidden" name="product_price" value="360">
            <input type="hidden" name="product_image" value="ccp.jpg"> 
               <input type="submit"  class="btn" name="add_to_cart" value="ordern now"></input></form>
            </div>
        </div>
        <div class="box">
            <img src="assest/images/g-8.jpg" alt="">
            <div class="content">
                <h3>tasty food</h3>
                <p>Lorem ipsum  sit, amet consectetur adipisicing elit. Deleniti, ipsum.</p>
                <form method="post" action="">
               <input type="hidden" name="product_name" value="Did Special Dark Choclate">
            <input type="hidden" name="product_price" value="180">
            <input type="hidden" name="product_image" value="g-8.jpg"> 
               <input type="submit"  class="btn" name="add_to_cart" value="ordern now"></input></form>
            </div>
        </div>
        <div class="box">
            <img src="assest/images/g-9.jpg" alt="">
            <div class="content">
                <h3>tasty food</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deleniti, ipsum.</p>
                <form method="post" action="">
               <input type="hidden" name="product_name" value="Did Special Main Courses">
            <input type="hidden" name="product_price" value="400">
            <input type="hidden" name="product_image" value="g-9.jpg"> 
               <input type="submit"  class="btn" name="add_to_cart" value="ordern now"></input></form>
            </div>
        </div>

    </div>

</section>
<script src="assest/js/script.js"></script>
</body>
</html>
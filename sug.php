<?php

@include 'config.php';

if(isset($_POST['send'])){

   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $fname = $_POST['foodname'];
   $sugg = $_POST['sug'];


      $insert_product = mysqli_query($conn, "INSERT INTO `sugg`(name, number, email, food,suggestion) VALUES('$name', '$number', '$email', '$fname' , '$sugg')");
      $message[] = 'Thank You For Your Suggestion';

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
    <title>loader</title>
</head>
<body>
<!-- order section starts  -->

<section class="order" id="order">

    <h1 class="heading"> <span>Give Your</span>  suggestion </h1>

    <div class="row">
        
        <div class="image">
            <img src="assest/images/order-img.jpg" alt="">
        </div>
        <?php
         
         $select = mysqli_query($conn, "SELECT * FROM `formtest` WHERE id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
        
      ?> 
        <form action="" method="post">
     

            <div class="inputBox">
                <input type="text" name="name" placeholder="Name" value="<?php echo $fetch['uname']; ?>">
                <input type="email" name="email" placeholder="Email" value="<?php echo $fetch['email']; ?>">
            </div>

            <div class="inputBox">
                <input type="number" name="number" placeholder="Number" value="<?php echo $fetch['phone'];?>">
                <input type="text" name="foodname" placeholder="Food name">
            </div>
           
            <textarea placeholder="Suggestion" name="sug"  cols="30" rows="10"></textarea>

            <input type="submit" name="send" value="Send" class="btn">

        </form>

    </div>

</section>

<!-- order section ends -->


<script src="assest/js/script.js"></script>
</body>
</html>
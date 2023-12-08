<?php
include 'config.php';
if(isset($_POST['pbtn'])){
         mysqli_query($conn, "DELETE FROM `cart`");
         
      }

      header('location:orders.php');
      ?>
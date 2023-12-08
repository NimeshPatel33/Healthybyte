<?php

session_start();

$servername = "localhost";
$uname = "root";
$pass = "";
$db = "db1";

$con=mysqli_connect($servername,$uname,$pass,$db);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      body {
   background-image: url("assest/images/home-bg.jpg");
 }
   </style>
</head>
<body>
        <div class="card" style="width: 18rem;">
        <?php
                //get search keyword
                $search = $_POST['search'];

                //sql query
                $sql = "SELECT * FROM food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                $res = mysqli_query($con,$sql);

                //count rows
                $count = mysqli_num_rows($res);

                //available or not
                if($count>0){
                    //food available
                    while($row=mysqli_fetch_assoc($res)){
                        //get details
                        $id = $row['id'];
                        $title = $row['title'];
                        $desc = $row['description'];
                        $price = $row['price'];
                        $img = $row['img_name'];
                        ?>
                        <img src="assest/images/<?php echo $img; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $title; ?></h5>
                            <p class="card-text"><?php echo $title; ?></p>
                            <p class="card-text">$<?php echo $price; ?></p>
                        </div>
                        <div class="card-body">
                            <a href="#" class="card-link">Order Now</a>
                        </div>
                    <?php    
                    }
                    
                    

                }
                else{
                    echo "<div class='error'>Food Not Found</div>";
                }

                ?>
        
        </div>
</body>
</html>
<!-- 
    <div class="card-group">
  <div class="card">
    <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
    </div>
    <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
    </div>
  </div>
  <div class="card">
    <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
    </div>
    <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
    </div>
  </div>
  <div class="card">
    <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
    </div>
    <div class="card-footer">
      <small class="text-muted">Last updated 3 mins ago</small>
    </div>
  </div>
</div>

-->
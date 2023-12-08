<?php
         
@include 'config.php';
$t=0;
      ?>





<!DOCTYPE html>
<html>

<head>
	<meta name="viewport"
		content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href=
"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="assest/css/style.css">
	<style>
		
		* {
			box-sizing: border-box;
		}
		
		
	
		/* Float three columns */
		.column {
			float: left;
			width: 33%;
			padding: 0 5px;
		}
		
		.row {
			margin: 0 -5px;
		}
	
		/* Clear floats after the columns */
		.row:after {
			content: "";
			display: table;
		}
	
	
		/* Style the cards */
		.card {
			padding: 10px;
			text-align: center;
			background-color: #ff3838;
			color: #ff3838;
		}
		
		.card:hover {
			transform: scale(1.01);
			background-color: black;
			transition-duration: 0.5s;
			color: white;
		}
		
		.fa {
			font-size: 50px;
		}
	</style>
</head>

<body>

	<div class="row">
		<div class="column">
			<div class="card">
				

<p><i class="fa fa-user"></i></p>
<?php
$user = mysqli_query($conn, "SELECT COUNT(*) AS ua FROM `formtest` ");
         if(mysqli_num_rows($user) > 0){
            while($row = mysqli_fetch_assoc($user)){
      ?>
      	<h3><?php echo $row['ua']; ?>+</h3>

<?php
            };    
            }else{
               echo "<div class='empty'>No User In Site</div>";
            };
            ?>


				
				

<p>Customers</p>


			</div>
		</div>
		<div class="column">
			<div class="card">
				

<p><i class="fa fa-appetizers-slice"></i></p>
<?php
$user = mysqli_query($conn, "SELECT COUNT(*) AS ua FROM `products` ");
         if(mysqli_num_rows($user) > 0){
            while($row = mysqli_fetch_assoc($user)){
      ?>
      	<h3><?php echo $row['ua']; ?>+</h3>

<?php
            };    
            }else{
               echo "<div class='empty'>No User In Site</div>";
            };
            ?>


				

<p>Food Items</p>


			</div>
		</div>
		<div class="column">
			<div class="card">
				

<p><i class="fa fa-utensils"></i></p>
<?php
$user = mysqli_query($conn, "SELECT COUNT(*) AS ua FROM `order` ");
         if(mysqli_num_rows($user) > 0){
            while($row = mysqli_fetch_assoc($user)){
      ?>
      	<h3><?php echo $row['ua']; ?>+</h3>

<?php
            };    
            }else{
               echo "<div class='empty'>No Customers In Site</div>";
            };
            ?>

			
				

<p>Orders Served</p>
</div>
		</div>

        <div class="column">
			<div class="card">
<p><i class="fa fa-hamburger"></i></p>
<?php

$user = mysqli_query($conn, "SELECT total_products FROM `order`");
         if(mysqli_num_rows($user) > 0){
            while($row = mysqli_fetch_assoc($user))
            {
                $t += $row['total_products'];
            };
      ?>
      	<h3><?php echo "$t"; ?>+</h3>
<?php
               
            }else{
               echo "<div class='empty'>No Customers In Site</div>";
            };
            ?>

			
				

<p>Items Selled</p>



			</div>
		</div>
	</div>
</body>

</html>

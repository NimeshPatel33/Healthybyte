
<?php
session_start();
?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Signup</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/lib/w3.css"> 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" type="text/css" href="assest/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assest/css/login.css">
    <!--Stylesheet-->
    <style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-image:url(assest/css/loginm.jpg);
	background-attachment: fixed;
	background-position: center center;
	background-repeat: no-repear;
	background-size: cover;
}
.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(
        #061d09,
            #cbff63
    );
    left: 200px;
    top: -80px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #ff512f,
        #f09819
    );
    right: -350px;
    bottom: -80px;
}
form{
    height: 580px;
    width: 400px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 70%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #000000;;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgb(180, 180, 180);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #cc0d4d;
}
.button1{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}
.social{
  margin-top: 30px;
  display: flex;
}
.social div{
  background: red;
  width: 150px;
  border-radius: 3px;
  padding: 5px 10px 10px 5px;
  background-color: rgba(255,255,255,0.27);
  color: #eaf0fb;
  text-align: center;
}
.social div:hover{
  background-color: rgba(255,255,255,0.47);
}
.social .fb{
  margin-left: 25px;
}
.social i{
  margin-right: 4px;
}
p{
    font-size:14px;
    margin-top:10px;
    margin-left:10px;
    color: #cc0d4d;
}
a{
    font-size:14px;
    color: #1526bf;
}

    </style> 
</head>
<body>


    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
               
    <form action="#" method="post" enctype="multipart/form-data">
            <h3>Sign Up</h3>
           
            <?php
            if(isset($error)){
               foreach($error as $error){
                  echo '<span class="error-msg">'.$error.'</span>';
               };
            };

            ?>
          
   <br>
      <input type="text" name="name" required  placeholder="User Name">
     
      <input type="file" name="image" accept="image/png, image/jpg, image/jpeg" class="box" required title="Enter Your Image" placeholder="User Image">
        
      <input type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="email" required placeholder="Email"  title="Enter Proper Email Address (example: example@gmail.com)" > 
        
      <input type="text" name="phnum" required placeholder="Phone Number" pattern="\d{1,10}"  maxlength="10"  minlegngth = "10" title="Please Enter 10 Numbers">
      
      <input type="password" name="password" required placeholder=" Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
  title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" >
        
      <input type="password" name="cpassword" required placeholder=" Confirm Password" >
    
      <input type="submit" name="submit" value="signup" class = "button1" >
<br>
      <p>If You Have Alredy an Account <a href="log.php">Click Here</a></p>
     
        </form>
</body>
</html>

<?php

$servername = "localhost";
	$uname = "root";
	$pass = "";
	$db = "db1";

	$con=mysqli_connect($servername,$uname,$pass,$db);
	

if(isset($_POST['submit']))
{

//    $name = $_POST['name'];
//    $email = $_POST['email'];
//    $number = $_POST['phnum'];
//    $pass = $_POST['password'];
//    $cpass = $_POST['cpassword'];
   
$name = mysqli_real_escape_string($con ,$_POST['name']);
$email =     mysqli_real_escape_string($con ,$_POST['email']);
$number = mysqli_real_escape_string($con ,$_POST['phnum']);
$pass =  mysqli_real_escape_string($con ,md5($_POST['password']));
$cpass = mysqli_real_escape_string($con ,md5($_POST['cpassword']));
$fName = $_FILES["image"]["name"];
$target_dir = "assest/uploaded_img/user/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//   $check = getimagesize($_FILES["image"]["tmp_name"]);
//   if($check !== false) {
//     echo "File is an image - " . $check["mime"] . ".";
//     $uploadOk = 1;
//   } else {
//     echo "File is not an image.";
//     $uploadOk = 0;
//   }
// }

// Check if file already exists
// if (file_exists($target_file)) {
//   echo "Sorry, file already exists.";
//   $uploadOk = 0;
// }

// // Check file size
// if ($_FILES["image"]["size"] > 50000000) {
//   echo "Sorry, your file is too large.";
//   $uploadOk = 0;
// }

// // Allow certain file formats
// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// && $imageFileType != "gif" ) {
//   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//   $uploadOk = 0;
// }

// Check if $uploadOk is set to 0 by an error
/*if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}*/
//$image = $_FILES['image']['name'];
//$image_tmp_name = $_FILES['image']['tmp_name'];
//$image_folder = 'assest/uploaded_img/user/'.$image;

   $select = " SELECT * FROM `formtest` WHERE email = '$email' ";

   $result = mysqli_query($con, $select);

   if(mysqli_num_rows($result) > 0){

    echo '<script>alert("Email Alredy Exists");</script>';

   }else{

      if($pass != $cpass)
      {
         // echo '<span class="error-msg">' ."Invalid Password!".'</span>';
         echo '<script>alert("Invalid Password")</script>';
  
      }
      else{
        
        $insert=mysqli_query($con, "INSERT INTO `formtest` SET uname = '$name',image = '$fName', email = '$email', phone='$number',pass = '$pass'" );
        // $insert = "INSERT INTO formtest( `uname`,`image`, `email`, `phone`, `pass`) VALUES ('$name','$image','$email','$number','$pass')";
        // mysqli_query($con, $insert);
         echo "<script>window.location.href='home.php'</script>";

         if($insert){
            //move_uploaded_file($image_tmp_name, $image_folder);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
           
        
         }else{
            $message[] = 'User could not be updated';
          
         }
        $mail = new PHPMailer(true);
        $body = "Dear" .$name.",

        We are delighted to welcome you to Healthybyte Cafe, where you can discover a cozy and welcoming place to enjoy great sides, delicious food, and good company. Thank you for joining our community of sides lovers and food enthusiasts!
        
        If you have any questions or feedback, please do not hesitate to contact us. We are always happy to hear from our customers and strive to make your experience at Healthybyte Cafe the best it can be.
        
        Thank you for choosing Healthybyte Cafe. We look forward to serving you soon!
        
        Best regards,
        
        Healthybyte Cafe Team";
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = '1vaibhupatel1@gmail.com';
        $mail->Password = 'miexhxavtovwzdbm';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('1vaibhupatel1@gmail.com');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = "Welcome to Healthybyte Cafe - Your Go-To Destination for Great Sides and More!";
        $mail->Body = $body;

        $mail->send();

        echo "<script>alert('Send Email');</script>";
         
      }
   }

};





?>
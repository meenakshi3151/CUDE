
<?php
function is_strong_password($password) {
  $lowercase = '/[a-z]/';
  $uppercase = '/[A-Z]/';
  $digits = '/[0-9]/';
  $special = '/[!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?]/';

  // Check if password meets requirements
  if (strlen($password) < 8) {
    echo "<script> alert('Enter a strong Password ');</script>";
  }
  if (!preg_match($lowercase, $password)) {
    echo "<script> alert('Enter a strong Password using lowercase');</script>";
  }
  if (!preg_match($uppercase, $password)) {
    echo "<script> alert('Enter a strong Password using uppercase');</script>";
  }
  if (!preg_match($digits, $password)) {
    echo "<script> alert('Enter a strong Password using digits');</script>";
  }
  if (!preg_match($special, $password)) {
    echo "<script> alert('Enter a strong Password using special characters');</script>";
  }
}
$server="localhost";
$username="root";
$password="";
$signin=false;
$db="cude";
$conn=mysqli_connect($server,$username,$password,$db);
if(isset($_POST['name'])){

$insert=true;
  $name=$_POST['name'];
 $gender=$_POST['gender'];
 $password=$_POST['password'];
 $phone=$_POST['phone'];
 $email=$_POST['email'];
 $regno=$_POST['regno'];
 $passe=false;
 $conpassword=$_POST['conpassword'];
 is_strong_password($password);
 if($password!=$conpassword){
    echo "<script> alert('Entered passwords does not match');</script>";
   }
   else{
    $email1 =$email;
     $query4 = "SELECT * FROM signup WHERE REGNO = '$regno'";
     $resultp = $conn->query($query4);
     if (mysqli_num_rows($resultp)>0) {
        echo "<script> alert('Registration Number is already registered with us');</script>";
     }
     else {
   
  $query="INSERT INTO `signup` (`Name`, `REGNO`, `PhoneNo`, `Gender`,`Email`,`Password`) VALUES ( '$name', '$regno', '$phone', '$gender','$email', '$password');";
 if($conn->query($query)==true){
   echo "<script> alert('You signed up successfully');</script>";
  
   }
 else{
   echo "ERROR:$sql<br";
 }
}
   }
  }
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="banner">
      <div class="navbar">
<img src="logo.jpg" class="logo">
<ul>
   
    <li><a href="#">Home</a></li>
    <li><a href="#">Rules</a></li>
    <li><a href="#">Team</a></li>
    <li><a href="#">About Us</a></li>
    <li><a href="http://www.mnnit.ac.in/">MNNIT</a></li>
</ul>
</div>

<div class="content">
    <h1>DAILY ENTRY</h1>
    <P>Check in if you are going out and check out if you have entered the hostel premises.</P>
<button type="button" id="checkin" onclick="checkin()"><span></span>Check IN</button>
   <button type="button" id="checkout" onclick="checkout()"><span></span>Check OUT</button>
  <p>Haven't entered details yet?</p> 
 <button type="button" id="signin"><span class="sign_up"></span><a href="signup.php">Sign UP</a></button>
</div>
   
</div>
<script>
     function checkin(){
      let currentTime = new Date();
      let hours = currentTime.getHours();
console.log(currentTime);
if (hours >=6 && hours< 22) {
  alert("You can go out now. " );
  let RegistrationNoo = prompt("Registration No:");
        let Passwordo=prompt("Password:");
      
} 
else {
  alert("You cannot go out!");
}
      
  }
  function checkout() {
  let currentTime = new Date();
  let hours = currentTime.getHours();
  console.log(currentTime);
  if ( hours >6 && hours < 22 ) {
    alert("You are on time!");
    let RegistrationNoi = prompt("Registration NO:");
    let Passwordi = prompt("Password:");
  } else {
    alert("You are late!");
    let RegistrationNol = prompt("Registration NO:");
    let Passwordl = prompt("Password:");
  }

}

</script>
</body>
</html>


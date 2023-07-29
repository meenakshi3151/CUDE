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
 
  if (isset($_POST['regno1'])) {
    $regno = $_POST['regno1'];
    $password = $_POST['password1'];
    
    $sql = "SELECT * FROM `login` WHERE REGNO=? AND Password=? AND Outtime IS NULL";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $regno, $password);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if (mysqli_num_rows($result) > 0) {
      $sql= "UPDATE `login` SET Outtime = current_timestamp() WHERE REGNO=? AND Outtime IS NULL";
      
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $regno);
      
      if($stmt->execute()){
        echo "<script> alert('You check out successfully');</script>";
      } else {
        echo "ERROR: " . $stmt->error;
      }
    } else {
      echo "<script> alert('You didn't do the entry while going');</script>";
    }
  }
  



?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Check Out </title>
    <link rel="stylesheet" href="style.css">
  </head>
  <style>
   
    .login-container {
  width: 400px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #f9f9f9;
  font-family: Arial, sans-serif;



}

h1 {
  text-align: center;
  font-size: 24px;
}
a{
  color:red;
}
form {
  display: flex;
  flex-direction: column;
}

label {
  margin-top: 10px;
  font-size: 18px;
}

input[type="text"],
input[type="password"] {
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
  font-size: 16px;
}

button[type="submit"] {
  margin-top: 20px;
  padding: 10px;
  border-radius: 5px;
  background-color: #4CAF50;
  color: white;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

button[type="submit"]:hover {
  background-color: #3e8e41;
}

    </style>

  <body>
    

    <div class="login-container">
      <h1>Check out</h1>
      <form action="checkout.php" method="post">
        <label for="Registration No">Registration No</label>
        <input type="text" id="regno1" name="regno1" required>
        <label for="password">Password</label>
        <input type="password" id="password1" name="password1" required>
      <pre>  <button type="submit">Check Out</button>   <button type="submit" name="home">Home Page<a href="index.php"></button></pre>
       
        
      </form>
      <a href="index.php">Go back to home page</a>
    </div>
  </body>
</html>

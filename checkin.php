<?php
function is_strong_password($password) {
  $lowercase = '/[a-z]/';
  $uppercase = '/[A-Z]/';
  $digits = '/[0-9]/';
  $special = '/[!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?]/';

  // Check if password meets requirements
  if (strlen($password) < 8) {
    return "Password must be at least 8 characters long.";
  }
  if (!preg_match($lowercase, $password)) {
    return "Password must contain at least one lowercase letter.";
  }
  if (!preg_match($uppercase, $password)) {
    return "Password must contain at least one uppercase letter.";
  }
  if (!preg_match($digits, $password)) {
    return "Password must contain at least one digit.";
  }
  if (!preg_match($special, $password)) {
    return "Password must contain at least one special character.";
  }
  return true;
}

$server="localhost";
$username="root";
$password="";
$signin=false;
$db="cude";
$conn=mysqli_connect($server,$username,$password,$db);

// if(isset($_POST['name'])){

//   $insert=true;
//   $name=$_POST['name'];
//   $gender=$_POST['gender'];
//   $password=$_POST['password'];
//   $phone=$_POST['phone'];
//   $email=$_POST['email'];
//   $regno=$_POST['regno'];
//   $passe=false;
//   $conpassword=$_POST['conpassword'];
  
  // Check password strength
//   $password_strength = is_strong_password($password);
//   if($password_strength !== true){
//     echo "<script> alert('$password_strength');</script>";
//     exit;
//   }

//   // Check if passwords match
//   if($password !== $conpassword){
//     echo "<script> alert('Entered passwords do not match.');</script>";
//     exit;
//   }
  
//   // Check if registration number is already registered
//   $query4 = "SELECT * FROM signup WHERE REGNO = '$regno'";
//   $resultp = $conn->query($query4);
//   if (mysqli_num_rows($resultp)>0) {
//     echo "<script> alert('Registration Number is already registered with us.');</script>";
//     exit;
//   }
   
//   // Insert user data into database
//   $query="INSERT INTO `signup` (`Name`, `REGNO`, `PhoneNo`, `Gender`,`Email`,`Password`) VALUES ( '$name', '$regno', '$phone', '$gender','$email', '$password');";
//   if($conn->query($query)==true){
//     echo "<script> alert('You signed up successfully.');</script>";
//   }
//   else{
//     echo "ERROR:$sql<br";
//   }
// }

if (isset($_POST['regno'])) {
  $regno = $_POST['regno'];
  $password = $_POST['password'];
  
  // Check if user exists in signup table
  $query_check_user = "SELECT * FROM signup WHERE REGNO='$regno' AND Password='$password'";
  $result_check_user = $conn->query($query_check_user);
  
  if (mysqli_num_rows($result_check_user) > 0) {
    // Insert user data into login table
    $query_insert_login = "INSERT INTO `login` (`Regno`, `Password`,`Intime`) VALUES ('$regno', '$password',current_timestamp())";
    if ($conn->query($query_insert_login) === true) {
      echo "<script> alert('Come by 10:00 P.M.');</script>";  
    }
  } else {
    echo "<script> alert('Login Credentials do not match. Please check your Registration Number and Password.');</script>";
  }
}

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Check In </title>
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
a{

   color:red;
}
h1 {
  text-align: center;
  font-size: 24px;
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
      <h1>Login</h1>
      <form action="checkin.php" method="post">
        <label for="Registration No">Registration No</label>
        <input type="text" id="regno" name="regno" required>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      <pre>  <button type="submit">Check In</button>   
      </form>
      <a href="index.php">Go back to home page</a>
    </div>
 
  </body>
</html>

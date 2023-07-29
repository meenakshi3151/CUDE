<?php
$yess=0;
function is_strong_password($password) {
  $lowercase = '/[a-z]/';
  $uppercase = '/[A-Z]/';
  $digits = '/[0-9]/';
  $special = '/[!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?]/';

  // Check if password meets requirements
  if (strlen($password) < 8) {
    echo "<script> alert('Enter a strong Password ');</script>";

    $yess=1;
  }
  // if (!preg_match($lowercase, $password)) {
  //   echo "<script> alert('Enter a strong Password using lowercase');</script>";
  // }
  // if (!preg_match($uppercase, $password)) {
  //   echo "<script> alert('Enter a strong Password using uppercase');</script>";
  // }
  if (!preg_match($digits, $password)) {
    echo "<script> alert('Enter a strong Password using digits');</script>";
    $yess=1;
  }
  if (!preg_match($special, $password)) {
    echo "<script> alert('Enter a strong Password using special characters');</script>";
    $yess=1;
  }
}

$server = "localhost";
$username = "root";
$password = "";
$db = "cude";
$conn = mysqli_connect($server, $username, $password, $db);

if (isset($_POST['signup'])) { // Check if the form is submitted

  $name = $_POST['name'];
  $gender = $_POST['gender'];
  $password = $_POST['password'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $regno = $_POST['regno'];
  $conpassword = $_POST['conpassword'];

  is_strong_password($password);
  if($yess==0){

  
    if ($password != $conpassword) {
      echo "<script> alert('Entered passwords do not match');</script>";
    } else {
      $query4 = "SELECT * FROM signup WHERE REGNO = '$regno'";
      $resultp = $conn->query($query4);
      if (mysqli_num_rows($resultp) > 0) {
        echo "<script> alert('Registration Number is already registered with us');</script>";
      } else {
     
        $query = "INSERT INTO `signup` (`Name`, `REGNO`, `PhoneNo`, `Gender`, `Email`, `Password`) 
                  VALUES ('$name', '$regno', '$phone', '$gender', '$email', '$password');";
        
        if ($conn->query($query) === true) {
          echo "<script> alert('You signed up successfully');</script>";
        } else {
          echo "ERROR: " . $conn->error;
        }
      }
    }
  }
}
?>
<!DOCTYPE html>
<!-- Rest of the HTML remains unchanged -->

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
  <style>
    /* Apply some basic styles to improve the form appearance */
body {
  background-color:skyblue;
  font-family: Arial, sans-serif;
}

.pages {
  display: flex;
  justify-content: center;
  align-items: center;
  color:antiquewhite;

  height: 100vh;
}

.sign-container {
  background-color:cadetblue;
  border-radius: 5px;
  padding: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.sign-form h2 {
  margin-bottom: 20px;
}

.form1 {
  margin-bottom: 10px;
}

label {
  display: inline-block;
  width: 120px;
  font-weight: bold;
}

input[type="text"],
input[type="email"],
input[type="password"],
input[type="tel"] {
  padding: 8px;
  border-radius: 5px;
  border: 1px solid #ccc;
  width: 100%;
  box-sizing: border-box;
}

input[type="submit"] {
  background-color: #4CAF50;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  cursor: pointer;
}
button {
  background-color: #4CAF50;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #3e8e41;
}
button{
  background-color: #3e8e41;

}
/* Apply responsive design to the form for different screen sizes */
@media screen and (max-width: 600px) {
  .sign-container {
    width: 90%;
  }
}

@media screen and (max-width: 400px) {
  label {
    display: block;
    width: 100%;
    margin-bottom: 5px;
  }
  
  input[type="text"],
  input[type="email"],
  input[type="password"],
  input[type="tel"] {
    width: 100%;
  }
}

  </style>
    <div class="pages">
  <div class="mar">
  <div class="sign-container">
    <form class="sign-form" method="post" action="signup.php">
      <h2>Sign In</h2>
      <div class="form1">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
      </div>
     
      <div class="form1">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="form1">
          <label for="phone">Phone Number:</label>
          <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" required>
        </div>
        <div class="form1">
          <label for="Registration Number">Registration no:</label>
          <input type="text" id="regno" name="regno" required></textarea>
        </div>
        <div class="form1">
          <label for="Gender">Gender:</label>
          <input type="text" id="gender" name="gender" required>
        </div>
        <div class="form1">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required>
        </div>
        <div class="form1">
          <label for="confirm-password">Confirm Password:</label>
          <input type="password" id="conpassword" name="conpassword" required>
        </div>
      <div class="form1">
        <input type="submit" value="SignUp" name="signup">
       
   </div>
   <button type="button" id="index"><span class="index"></span><a href="index.php">Back to Home</a></button>
  </div>
 </div>
 
</body>
</html>

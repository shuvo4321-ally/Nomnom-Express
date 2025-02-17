<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="About the site" />
  <meta name="author" content="Author name" />
  
  <link href="signin.css" rel="stylesheet" /> 
  <title>Signup</title>
</head>

<body>
  <div class="login-wrap">
      <h2>Sign Up</h2>
      <form action="signup.php" class="form esign" method="post"> 
        <input type="text" placeholder="User_Id" name="user_id" />
        <input type="text" placeholder="User_name" name="name" />
        <input type="text" placeholder="address" name="address" />
        <input type="text" placeholder="Email" name="email" />
        <input type="password" placeholder="Set Password" name="pass" />
        <button>Sign up</button>
      </form>
      <p>Back to <a href="signin.php">Login</a>.</p> 
  </div>

  <?php
require_once('dbconnect.php');

$id = $_POST['user_id'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$name = $_POST['name'];
$address = $_POST['address'];
if ($id[0] == "c" or $id[0] == "r"){
$sql = "INSERT INTO user (user_id, email, password) VALUES ('$id', '$email', '$pass')";

if ($conn->query($sql) === TRUE) {
    echo 'User created.';
    
    if ($id[0] == 'c') {
        $ssql = "INSERT INTO customer (customer_id, customer_name, customer_address) VALUES ('$id', '$name', '$address')";
  
        if ($conn->query($ssql) === TRUE) {
            echo 'Customer created.';
        } else {
            echo 'Something went wrong: ' . $conn->error;
        }
    } else if ($id[0] == 'r') { 
        $rsql = "INSERT INTO rider (rider_id, rider_name, rider_status) VALUES ('$id', '$name', 'available')";
    
        if ($conn->query($rsql) === TRUE) {
            echo 'Rider created.';
        } else {
            echo 'Something went wrong: ' . $conn->error;
        }
    }}
} else {
    echo 'Something went wrong: ' . $conn->error;
}
?>


  
</body>

</html>

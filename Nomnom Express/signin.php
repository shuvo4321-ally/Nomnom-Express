<link href="signin.css" rel="stylesheet"/> 
<title>Login</title>
<div class="login-wrap">
    

  <h2>Sign In</h2>
  
  <div>
  <form action="signin.php" class="form design" method="post">
    <input type="text"  placeholder="Username" name="user_id" />
    <input type="password"  placeholder="Password" name="password" />
    <button> Sign in </button>
    <h3><a href="signup.php"> <p> Don't have an account? Register </p></a></h3>
    
  </div>
</div>


<?php
session_start(); 

require_once('dbconnect.php'); 

if(isset($_POST['user_id']) && isset($_POST['password'])){
    $u = $_POST['user_id'];
    $p = $_POST['password'];
    $sql = "SELECT * FROM user WHERE user_id = '$u' AND password = '$p'";

    $result = mysqli_query($conn, $sql);    
    if(mysqli_num_rows($result) !=0 ){
        $row = $result->fetch_assoc();

        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['logged_in'] = true;
        if($row['user_id'][0] == 'c'){
            header("Location: cus.php");
            exit();
        }
        else if($row['user_id'][0] == 'r'){
            header("Location: rid.php");
            exit();
        }
    }
    else{

        echo "User ID not found. Please register.";
        echo '<a href="register.php">Register</a>';
    }   
}
?>








<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="About the site"/>
    <meta name="author" content="Author name"/>
    <title>ABC School</title>
     -->
    <!-- core CSS -->
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/font-awesome.min.css" rel="stylesheet"/>
    <link href="css/animate.min.css" rel="stylesheet"/>
    <link href="css/main.css" rel="stylesheet"/>  -->
    <!-- <link href="css/style.css" rel="stylesheet"/> Connect the custom CSS -->
    <!-- <link href="index.css" rel="stylesheet"/> 
</head>
<div class="login-wrap">
    

  <h2>Sign In</h2>
  
  <div>
  <form action="signin.php" class="form esign" method="post">
    <input type="text"  placeholder="Username" name="fname" />
    <input type="password"  placeholder="Password" name="pass" />
    <button> Sign in </button> -->
    <!-- <a href="#"> <p> Don't have an account? Register </p></a> -->
  <!-- </div>
</div> -->




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NomNomExpress!</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>

<body>
    <nav>
        <div class=" logo">NomNom Express</div>
        <div class="nav-items">
            <a href="about.php">ABOUT</a>
            <a href="signin.php">LOGIN</a>
            <a href="signup.php">SIGN UP</a>
        </div>
    </nav>
    <section class= "front">
        <div class="front-container">
            <div class= "column-left">
                <h1>Your Food Is One Click Away</h1>
                <p>Choose and get your food from anywhere, anytime with just one click. Order Now!!!</p>
                <!-- <button onclick="window.location.href='signup.php'">Let's Start</button> -->
            </div>
            <!-- <div>
                <div class="column-right">
                    <img src=logo.png
                    alt="illust" class= "front-image">
                </div> -->
            </div>
        </div>
    </section>
    <style>
        *{
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    }

    nav {
        height: 100px;
        background: #920351 ;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0rem calc((100vw -1300px) / 2);
        
    }
    
    .logo {
        color: #ECF4D6;
        font-size: 2rem;
        font-weight: bold;
        font-style: italic;
        padding: 0 2rem;
        
    }

    nav a {
        text-decoration: none;
        font-size: 1.3rem;
        color: #9AD0C2;
        padding: 0 1.5rem;

        
    }

    nav a:hover {
        color: #ECF4D6;
    }
    .front {
        background: #ECF4D6; 
    }
    .front-container {
        margin-left: 2rem;
        display:grid ;
        grid-template-columns: 1fr 1fr ;
        height:95vh ;
        padding: 3rem calc((100vw -1300px) / 2);
    }

    .column-left {
        display:flex ;
        flex-direction:column ;
        justify-content:center ;
        align-items:flex-start ;
        color:#265073 ;
        padding: 0rem 2rem;
    }

    .column-left h1 {
        margin-bottom: 1rem;
        font-size: 3rem;
    }

    .column-left p {
        margin-bottom: 2rem;
        font-size: 1.5rem;
        line-height: 1.5;
    }

    button {
        padding: 1rem 3rem ;
        font-size: 1rem;
        border: none;
        color: #ECF4D6;
        background: #265073;
        cursor:pointer ;
        border-radius: 50px;
    }

    button:hover{
        background: #9ad0c2;
        color: #265073;
        
    }

    .column-right {
        display:flex;
        justify-content:center;
        align-items: center;
        padding: 0rem 2rem;
        margin-top: 30px;
    }

    .front-image {
        width: 30%;
        height: 30%;
    }
    @media screen and (max-width: 768px) {
        .front-container{
            grid-template-columns: 1fr;

        }
    }
        
    </style>
</body>
</html>
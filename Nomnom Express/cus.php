<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Page</title>
    <link rel="stylesheet" href="cus_man.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="cus.php">Dashboard</a></li>
                <li><a href="show_restaurants.php">Restaurants</a></li>
                <li><a href="show_cart.php">Cart</a></li>
                <li><a href="show_order.php">Order</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="index.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <section class="content">
        <h2>Hello Customer!</h2>
        <div id="welcomeMessage"></div>

        <div class="dashboard-section">
            <h3>Wanna Order Some Food?</h3>
            <ul>
                <li><a href="show_restaurants.php">YES!!</a></li>
                <li><a href="index.php">NO :(</a></li>
            </ul>
        </div>
        <script>
            function showGreeting() {
                const date = new Date();
                const hours = date.getHours();
                let greeting;
                if (hours < 12) greeting = 'Good morning!';
                else if (hours < 18) greeting = 'Good afternoon!';
                else greeting = 'Good evening!';
                document.getElementById('welcomeMessage').innerHTML = <h3>${greeting}</h3>;
            }
            showGreeting();
        </script>
    </section>
    <footer>
        <p>&copy; 2024 Food Delivery</p>
    </footer>
</body>
</html>
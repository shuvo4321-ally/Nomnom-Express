<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Page</title>
    <link rel="stylesheet" href="cus_man.css">
</head>
<body>
    <header>
        <h1>Welcome Rider!</h1>
        <nav>
            <ul>
                <li><a href="rid.php">Dashboard</a></li>
                <li><a href="rid_orders.php">Orders</a></li>
                <li><a href="current_order.php">Your Orders</a></li>
                <li><a href="show_orderhist.php">Order History</a></li>
                <li><a href="profile_rid.php">Profile</a></li>
                <li><a href="index.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <section class="content">
        <h2>Rider Central: Your Hub for Seamless Deliveries</h2>
        <div class="dashboard-info">
            <h3>Today's Schedule</h3>
            <p>Check out the orders for today's deliveries and optimize your travel.</p>
            <button class="btn" onclick="window.location='current_order.php';">View Routes</button>
        </div>

    </section>
    <footer>
        <p>&copy; 2024 Food Delivery</p>
    </footer>
</body>
</html>
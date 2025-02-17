<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    session_start(); // Start or resume the session

    // Set the page title based on the session variable
    $pageTitle = "Orders"; // Default title
    if (isset($_SESSION['user_id'])) {
        $pageTitle .= " - RIDER ID: " . htmlspecialchars($_SESSION['user_id']);
    }
    ?>
    <title><?php echo $pageTitle; ?></title> <!-- Dynamic title based on session variable -->
    <link rel="stylesheet" href="restaurant.css">
</head>
<body>
    <header>
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
        <h2>New Orders!!!</h2>
    </section>
    <table border="1">
        <tr>
            <th>Order ID</th>
            <th>Restaurant ID</th>
            <th>Delivery Location</th>
        </tr>

        <?php
        require_once('dbconnect.php'); // Include your DB connection
        
        $sql = "SELECT o.order_id, o.restaurant_id, o1.order_location FROM orderinfo o, orderhistory o1 WHERE o.order_id=o1.order_id and o1.order_status='pending'"; // Update your query
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["order_id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["restaurant_id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["order_location"]) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No new orders</td></tr>";
        }
        $conn->close();
        ?>

    </table>
    <h2>Pick An Order To Deliver</h2>
    <section id="section1">
        <form action="add_order.php" class="form_design" method="post">
            Enter Your Order ID: <input type="text" name="order_id"> <br/>
            <input type="submit" value="PICK">
        </form>
    </section>
    <footer>
        <p>&copy; 2024 Food Delivery</p>
    </footer>
</body>
</html>

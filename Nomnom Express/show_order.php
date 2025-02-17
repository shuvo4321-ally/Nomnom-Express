<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="restaurant.css">
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
        <h2>Your Orders</h2>
    </section>
    <table border="1">
        <tr>
            <th>Order ID</th>
            <th>Transaction ID</th>
            <th>Restaurant ID</th>
            <th>Rider ID</th>
        </tr>

        <?php
        session_start();
        require_once('dbconnect.php');
        $customer_id = $_SESSION['user_id'];

        $sql = "SELECT o.order_id, p.transaction_id, o.restaurant_id, o.rider_id FROM orderinfo o, payment p WHERE o.transaction_id = p.transaction_id and p.customer_id= ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $customer_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["order_id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["transaction_id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["restaurant_id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["rider_id"]) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No orders found</td></tr>";
        }
        ?>
    </table>

    <footer>
        <p>&copy; 2024 Food Delivery</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>

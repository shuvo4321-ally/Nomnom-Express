<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
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
    <?php
    session_start();
    if (isset($_SESSION['user_id'])) {
        echo "<p>RIDER ID: " . htmlspecialchars($_SESSION['user_id']) . "</p>";
    } else {
        echo "<p>Rider ID is not set in the session.</p>";
    }
    ?>
    <section class="content">
        <h2>Order History</h2>

    </section>
    <table border="1">
        <tr>
            <th>Order ID</th>
            <th>Restaurant ID</th>
            <th>Customer ID</th>
            <th>Order Status</th>
        </tr>

        <?php
        require_once('dbconnect.php');
        $rider_id = $_SESSION['user_id'];

        $sql = "SELECT o.order_id, o.restaurant_id, p.customer_id, o1.order_status FROM orderinfo o, orderhistory o1, payment p WHERE o.order_id=o1.order_id AND o.transaction_id=p.transaction_id AND o1.order_status='delivered' AND o1.rider_id= ?"; // Update your query
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $rider_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["order_id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["restaurant_id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["customer_id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["order_status"]) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No results found</td></tr>";
        }
        $stmt->close();
        $conn->close();
        ?>

    </table>

    <footer>
        <p>&copy; 2024 Food Delivery</p>
    </footer>
</body>
</html>

<?php
session_start();
require_once('dbconnect.php');
$customer_id = $_SESSION['user_id'];

$message = [];

if(isset($_POST['add_to_cart'])){
    $restaurant_id = $_POST['restaurant_id'];
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];

    $check_cart_query = "SELECT * FROM cart WHERE customer_id = ? LIMIT 1";
    $check_cart_statement = $conn->prepare($check_cart_query);
    $check_cart_statement->bind_param("s", $customer_id);
    $check_cart_statement->execute();
    $check_cart_result = $check_cart_statement->get_result();

    if ($check_cart_result->num_rows > 0) {
        $row = $check_cart_result->fetch_assoc();
        if ($row['restaurant_id'] !== $restaurant_id) {
            $message[] = 'Please empty your cart before ordering from another restaurant.';
        }
    }

    if(empty($message)){
        $cart_id = $customer_id . '_' . uniqid();

        $check_item_query = "SELECT * FROM restaurant WHERE restaurant_id = ? AND item_id = ?";
        $check_item_statement = $conn->prepare($check_item_query);
        $check_item_statement->bind_param("ss", $restaurant_id, $item_id);
        $check_item_statement->execute();
        $check_item_result = $check_item_statement->get_result();

        if($check_item_result->num_rows > 0){

            $row = $check_item_result->fetch_assoc();
            $item_price = $row['item_price'];

            $insert_query = "INSERT INTO cart (cart_id, item_id, quantity, item_price, restaurant_id, customer_id) VALUES (?, ?, ?, ?, ?, ?)";
            $insert_statement = $conn->prepare($insert_query);
            $insert_statement->bind_param("ssssss", $cart_id, $item_id, $quantity, $item_price, $restaurant_id, $customer_id);
            if($insert_statement->execute()){
                $message[] = 'Product added to cart successfully';
            } else {
                $message[] = 'Error adding product to cart: ' . $conn->error;
            }
        } else {
            $message[] = 'Item not available in the selected restaurant';
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurants</title>
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
        <h2>Restaurants</h2>
    </section>
    <table border="1">
        <tr>
            <th>Restaurant ID</th>
            <th>Restaurant Name</th>
            <th>Item ID</th>
            <th>Item Name</th>
            <th>Price</th>
        </tr>

        <?php
        $sql = "SELECT * FROM restaurant"; 
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["restaurant_id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["restaurant_name"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["item_id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["item_name"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["item_price"]) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No restaurants found</td></tr>";
        }
        ?>
    </table>
    <h2>Add Items To Cart</h2>
    <section id="section1">
        <form action="" class="form_design" method="post">
            Enter Restaurant ID: <input type="text" name="restaurant_id"> <br/>
            Enter Item ID: <input type="text" name="item_id"> <br/>
            Enter Quantity: <input type="text" name="quantity"> <br/>
            <input type="submit" class="btn" value="Add to Cart" name="add_to_cart">
        </form>
        <?php 
        if(isset($message)){
            foreach($message as $msg){
                echo "<p>$msg</p>";
            }
        }
        ?>
    </section>
    <footer>
        <p>&copy; 2024 Food Delivery</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>

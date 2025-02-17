<?php
session_start();
require_once('dbconnect.php'); 

if (!isset($_SESSION['user_id'])) {

    header("Location: signin.php");
    exit();
}
$customer_id = $_SESSION['user_id'];

$select_cart_query = "SELECT cart.*, restaurant.item_name, restaurant.restaurant_id FROM cart INNER JOIN restaurant ON cart.item_id = restaurant.item_id WHERE cart.customer_id = '$customer_id'";
$select_cart_result = $conn->query($select_cart_query);


$grand_total = 0;

function generateOrderID() {
    return uniqid('O');
}

function generateTransactionID() {
    return uniqid('T');
}

function insertOrderInfo($orderID, $restaurantID, $transactionID, $riderID) {
    global $conn;
    $insert_query = $conn->prepare("INSERT INTO orderinfo (order_id, restaurant_id, transaction_id, rider_id) VALUES (?, ?, ?, ?)");
    $insert_query->bind_param("ssss", $orderID, $restaurantID, $transactionID, $riderID);
    $insert_query->execute();
    return $orderID; 
}

function insertOrderHistory($orderID, $orderLocation) {
    global $conn;
    $order_status = "pending"; 
    $insert_query = $conn->prepare("INSERT INTO orderhistory (order_id, order_location, order_status) VALUES (?, ?, ?)");
    $insert_query->bind_param("sss", $orderID, $orderLocation, $order_status);
    $insert_query->execute();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_order'])) {

    $payment_option = $_POST['payment_option'];
    $order_location = $_POST['order_location'];

    $orderID = generateOrderID();
    $transactionID = generateTransactionID();

    $insert_payment_query = $conn->prepare("INSERT INTO payment (transaction_id, payment_option, customer_id, cart_id) VALUES (?, ?, ?, ?)");
    $insert_payment_query->bind_param("ssss", $transactionID, $payment_option, $customer_id, $cart_id);

    $cart_id_query = "SELECT cart_id FROM cart WHERE customer_id = '$customer_id'";
    $cart_id_result = $conn->query($cart_id_query);
    if ($cart_id_result->num_rows > 0) {
        $cart_id_row = $cart_id_result->fetch_assoc();
        $cart_id = $cart_id_row['cart_id'];

        $insert_payment_query->execute();

        if ($select_cart_result->num_rows > 0) {
            $first_row = $select_cart_result->fetch_assoc();
            $restaurantID = $first_row['restaurant_id'];
        }

        $riderID = 'null'; 

        $orderID = insertOrderInfo($orderID, $restaurantID, $transactionID, $riderID);

        insertOrderHistory($orderID, $order_location);
        $delete_cart_query = "DELETE FROM cart WHERE customer_id = '$customer_id'";
        $conn->query($delete_cart_query);

        header("Location: payment_success.php?order_id=$orderID&transaction_id=$transactionID");
        exit();
    } else {
        echo "Cart is empty.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="checkout.css">
</head>
<body>
<div class="container">
    <section class="checkout">
        <h1 class="heading">Order Summary</h1>
        <h3 class="hcus">  <?php echo "Hi"," ",''.$customer_id.'',", Look at your checkout.";?></h3>
        <table>
            <thead>
            <th>Item Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
            </thead>
            <tbody>
            <?php 
            if ($select_cart_result->num_rows > 0) {
                while ($row = $select_cart_result->fetch_assoc()) {
                    $sub_total = $row['item_price'] * $row['quantity'];
                    $grand_total += $sub_total;
            ?>
            <tr>
                <td><?php echo $row['item_name']; ?></td>
                <td>$<?php echo number_format($row['item_price']); ?>/-</td>
                <td><?php echo $row['quantity']; ?></td>
                <td>$<?php echo number_format($sub_total); ?>/-</td>
            </tr>
            <?php 
                }
            }
            ?>

            <tr>
                <td colspan="3">Grand Total</td>
                <td>$<?php echo number_format($grand_total); ?>/-</td>
            </tr>

            </tbody>
        </table>

        <div class="order-number">
            <p>Your Order Number: <?php echo generateOrderID(); ?></p>
        </div>

        <div class="payment-section">
            <h2 class="payment-heading">Payment</h2>

            <form action="" class="form_design" method="post">
 
                Payment Method: 
                <select name="payment_option">
                    <option value="COD">Cash on Delivery</option>
                    <option value="Credit Card">Credit Card</option>
                </select><br/>
                Order Location: <input type="text" name="order_location" required> <br/>
                <input type="submit" class="btn" value="Confirm Order" name="confirm_order">
            </form>
        </div>
    </section>
</div>
</body>
</html>
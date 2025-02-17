<?php
session_start();
require_once('dbconnect.php');
$profile_id = $_SESSION['user_id'];

if (isset($profile_id)) {
    $rider_id = $profile_id;

    $rider_query = "SELECT rider_id, rider_name, rider_status FROM rider WHERE rider_id = '$rider_id'";
    $rider_result = $conn->query($rider_query);

    $user_query = "SELECT email FROM user WHERE user_id = '$rider_id'";
    $user_result = $conn->query($user_query);

    if ($rider_result && $user_result) {

        $rider_row = $rider_result->fetch_assoc();
        $rider = $rider_row['rider_id'];
        $rider_name = $rider_row['rider_name'];
        $rider_status = $rider_row['rider_status'];

        $user_row = $user_result->fetch_assoc();
        $email = $user_row['email'];
    } else {
        echo "Error fetching data from database: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="cus_man.css">
    <style>
        .profile-picture {
            width: 150px;
            height: 150px;
            background-color: #ccc;
            border-radius: 50%;
            margin: 20px auto;
        }
    </style>
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
        <h2>Profile</h2>
        <div class="profile-picture"></div>
        <table>
            <tr>
                <td>ID:</td>
                <td><?php echo $rider_id; ?></td>
            </tr>
            <tr>
                <td>Name:</td>
                <td><?php echo $rider_name; ?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><?php echo $email; ?></td>
            </tr>
            <tr>
                <td>Status:</td>
                <td><?php echo $rider_status; ?></td>
            </tr>
            
        </table>
    </section>
    <footer>
        <p>&copy; 2024 Food Delivery</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>

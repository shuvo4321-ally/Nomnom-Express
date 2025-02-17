<?php
session_start();
require_once('dbconnect.php'); 
$profile_id = $_SESSION['user_id'];

if (isset($profile_id)) {
    $customer_id = $profile_id;

    $customer_query = "SELECT customer_id, customer_name, referred, referred_points FROM customer WHERE customer_id = '$customer_id'";
    $customer_result = $conn->query($customer_query);

    $user_query = "SELECT email FROM user WHERE user_id = '$customer_id'";
    $user_result = $conn->query($user_query);

    if ($customer_result && $user_result) {
        $customer_row = $customer_result->fetch_assoc();
        $customer_id = $customer_row['customer_id'];
        $customer_name = $customer_row['customer_name'];
        $referred_by = $customer_row['referred'];
        $referral_points = $customer_row['referred_points'];

        $user_row = $user_result->fetch_assoc();
        $email = $user_row['email'];

        if ($referred_by === null) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $reference = $_POST['reference'];

                $reference_query = "SELECT customer_id FROM customer WHERE customer_id = '$reference'";
                $reference_result = $conn->query($reference_query);

                if ($reference_result->num_rows > 0) {
                    $update_query = "UPDATE customer SET referred = '$reference' WHERE customer_id = '$customer_id'";
                    $conn->query($update_query);

                    $increase_points_query = "UPDATE customer SET referred_points = referred_points + 5 WHERE customer_id = '$reference'";
                    $conn->query($increase_points_query);

                    $referred_by = $reference;
                }
            }

            echo '<form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">';
            echo 'Reference ID: <input type="text" name="reference">';
            echo '<input type="submit" value="Submit">';
            echo '</form>';
        }
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
        <h2>Profile</h2>
        <div class="profile-picture"></div>
        
        <table>
            <tr>
                <td>ID:</td>
                <td><?php echo $customer_id; ?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><?php echo $email; ?></td>
            </tr>
            <tr>
                <td>Name:</td>
                <td><?php echo $customer_name; ?></td>
            </tr>
            <tr>
                <td>Referred By:</td>
                <td><?php echo $referred_by ?? "None"; ?></td>
            </tr>
            <tr>
                <td>Referral Points:</td>
                <td><?php echo $referral_points; ?></td>
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

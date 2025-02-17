<?php
if(isset($_GET['transaction_id']) && isset($_GET['order_id'])) {
    $transaction_id = $_GET['transaction_id'];
    $order_id = $_GET['order_id'];
} else {

    header("Location: error_page.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Payment Success</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="payment_success.css">

</head>
<body>

<div class="container">

<section class="payment-success">
   <h1 class="heading">Payment Successful</h1>

   <p>Your transaction was successful!</p>
   <p>Transaction ID: <?php echo $transaction_id; ?></p>
   <p>Order ID: <?php echo $order_id; ?></p>
   <div class="back-btn">
      <a href="show_restaurants.php" class="btn">Search More Food</a>
   </div>
</section>

</div>

</body>
</html>

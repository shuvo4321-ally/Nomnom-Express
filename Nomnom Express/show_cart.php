<?php
session_start();
require_once('dbconnect.php');

$customer_id = $_SESSION['user_id'];

if(isset($_POST['update_update_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE item_id = ?");
   $update_quantity_query->bind_param("ss", $update_value, $update_id);
   if($update_quantity_query->execute()){
      header('location: show_cart.php');
   }
}

if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    $remove_query = $conn->prepare("DELETE FROM `cart` WHERE item_id = ?");
    $remove_query->bind_param("s", $remove_id);
    if($remove_query->execute()){
        header('location: show_cart.php');
    }
}

if(isset($_GET['delete_all'])){
    $delete_all_query = $conn->prepare("TRUNCATE TABLE `cart`");
    if($delete_all_query->execute()){
        header('location: show_cart.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="cart.css">

</head>
<body>

<div class="container">


<section class="shopping-cart">

   <h2 class="heading">Cart</h2>
   
   <table>

      <thead>
         <th>Item_id</th>
         <th>Item_name</th>
         <th>Restaurant_name</th>
         <th>Price</th>
         <th>Quantity</th>
         <th>Total_price</th>
      </thead>

      <tbody>
      <h6 class="hcus">  <?php echo "Hi"," ",''.$customer_id.'',", Look at your cart.";?></h6>
         <?php 
         
         $sql = "SELECT restaurant.restaurant_name,cart.item_id, restaurant.item_name, cart.item_price, cart.quantity FROM cart INNER JOIN restaurant ON cart.item_id = restaurant.item_id WHERE customer_id = ?";
         $select_cart = $conn->prepare($sql);
         $select_cart->bind_param("s", $customer_id);
         $select_cart->execute();
         $result = $select_cart->get_result();
         $grand_total = 0;
         if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
               $sub_total = $row['item_price'] * $row['quantity'];
               $grand_total += $sub_total;
         ?>

         <tr>
            <td><?php echo $row['item_id']; ?></td>
            <td><?php echo $row['item_name']; ?></td>
            <td><?php echo $row['restaurant_name']; ?></td>
            <td>$<?php echo number_format($row['item_price']); ?>/-</td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="update_quantity_id"  value="<?php echo $row['item_id']; ?>" >
                  <input type="number" name="update_quantity" min="1"  value="<?php echo $row['quantity']; ?>" >
                  <input type="submit" value="update" name="update_update_btn">
               </form>
            </td>
            <td>$<?php echo $sub_total = number_format($row['item_price'] * $row['quantity']); ?>/-</td>

            <td><a href="show_cart.php?remove=<?php echo $row['item_id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> remove</a></td>
            
         </tr>
         

         <?php 
         
            }
         }
         ?>
             <tr class="grand-total-row">
        <td colspan="3">Grand Total</td>
        <td>$<?php echo $grand_total; ?>/-</td>
        <td></td>
    </tr>
         <tr><td><a href="show_cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-all"> <i class="fas fa-trash"></i> delete all </a></td></tr>
         <tr>
            <td colspan="2"><a href="show_restaurants.php" class="continue-shopping">Continue</a></td>
         </tr>
      </tbody>
   </table>
   <div class="checkout-btn">
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
   </div>
</section>

</div>

</body>
</html>

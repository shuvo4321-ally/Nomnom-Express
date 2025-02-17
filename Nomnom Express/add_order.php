<?php
session_start();
require_once('dbconnect.php'); 
$rider_id = $_SESSION['user_id'];

if(isset($_POST['order_id'])) {

    $data = $_POST['order_id'];
    
 
    $conn->begin_transaction();
    $stmt0 = $conn->prepare("SELECT 1 FROM orderhistory WHERE order_id = ? and order_status= 'pending'");
    $stmt0->bind_param("s", $data);  
    $stmt0->execute();
    $result = $stmt0->get_result();
    if ($result->num_rows > 0) {
        try {
            
            $stmt1 = $conn->prepare("UPDATE orderinfo SET rider_id = ? WHERE order_id= ?");
            $stmt1->bind_param("ss", $rider_id, $data); 
            $stmt1->execute();

            $stmt2 = $conn->prepare("UPDATE orderhistory SET rider_id = ? , order_status='ongoing' WHERE order_id= ? ");
            $stmt2->bind_param("ss", $rider_id, $data); 
            $stmt2->execute();
            

            $conn->commit();
            
 
            header("Location: current_order.php");
            exit();
        } catch (Exception $e) {

            $conn->rollback();
            header("Location: rid_orders.php");
            exit();
        }
    } else {
        echo "Value does not exist in the table.";
        header("Location: rid_orders.php");
    }
} else {

    header("Location: rid_orders.php");
    exit();
}
?>

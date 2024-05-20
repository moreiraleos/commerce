<?php
require_once "../server/connection.php";

if (isset($_POST['edit_btn'])) {
    $order_id = filter_var($_POST['order_id'], FILTER_VALIDATE_INT);
    $order_status  = htmlspecialchars($_POST['order_status']);

    $stmt1 = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id = ? LIMIT 1");
    $stmt1->bind_param("si", $order_status, $order_id);
    if ($stmt1->execute()) {
        header("Location: index.php?edit_success_message=Order has been updated sucessfully");
    } else {
        header("Location: index.php?edit_failure_message=Error occured, try again");
        exit;
    }
} else {
    header('Location: index.php');
}

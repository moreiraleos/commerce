<?php
session_start();
require_once "../server/connection.php";

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['order_id'])) {
    $order_id = filter_var($_GET['order_id'], FILTER_VALIDATE_INT);

    // CHECKIN ORDER IS DIFF NOT PAID
    $stmt1 = $conn->prepare("SELECT order_status FROM orders WHERE order_id = ?");
    $stmt1->bind_param("i", $order_id);
    $stmt1->execute();
    $order_status = $stmt1->get_result()->fetch_object()->order_status;

    if ($order_status != 'not paid') {
        header("Location: index.php?edit_failure_message=Error occured, not is possible delete product");
        exit;
    }

    // REMOVE PRODUCT
    $stmt = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
    $stmt->bind_param("i", $order_id);
    if ($stmt->execute()) {
        header("Location: index.php?edit_success_message=Product has been deleted sucessfully");
    } else {
        header("Location: index.php?edit_failure_message=Error occured, try again");
    }
}

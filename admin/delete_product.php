<?php
session_start();
require_once "../server/connection.php";

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['product_id'])) {
    $product_id = filter_var($_GET['product_id'], FILTER_VALIDATE_INT);

    // CHECKIN PRODUCT ITS RELATED IN ORDER
    $stmt1 = $conn->prepare("SELECT * FROM order_items WHERE product_id = ?");
    $stmt1->bind_param("i", $product_id);
    $stmt1->execute();
    if ($stmt1->get_result()->num_rows > 0) {
        header("Location: products.php?edit_failure_message=Error occured, not is possible delete product");
        exit;
    }

    // REMOVE PRODUCT
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    if ($stmt->execute()) {
        header("Location: products.php?edit_success_message=Product has been deleted sucessfully");
    } else {
        header("Location: products.php?edit_failure_message=Error occured, try again");
    }
}

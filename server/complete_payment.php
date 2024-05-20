<?php
session_start();

require_once "connection.php";

// var_dump($_GET);
// exit;

if (isset($_GET['transaction_id']) && isset($_GET['order_id'])) {

    // $order_status = htmlspecialchars($_GET['order_status']);
    $order_status = "paid";
    $order_id = filter_var($_GET['order_id'], FILTER_VALIDATE_INT);
    $transaction_id = $_GET['transaction_id'];
    $user_id = filter_var($_SESSION['user_id'], FILTER_VALIDATE_INT);
    // $payment_date = date('Y-m-d H:i:s');

    // change order_status to paid
    $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");
    $stmt->bind_param("si", $order_status, $order_id);
    $stmt->execute();

    // store payment info
    $stmt1 = $conn->prepare("INSERT INTO payments(order_id, user_id, transaction_id) 
    VALUES(?,?,?)");
    // $stmt1 = $conn->prepare("INSERT INTO payments(order_id, user_id, transaction_id,payment_date) VALUES(?,?,?,?)");
    // $stmt1->bind_param("iiis", $order_id, $user_id, $transaction_id, $payment_date);
    $stmt1->bind_param("iis", $order_id, $user_id, $transaction_id);
    $stmt1->execute();

    // go to user account
    header("Location: ../account.php?payment_message=paid successfully, thanks for your shopping with us");
} else {
    header("Location: ../index.php");
    exit;
}

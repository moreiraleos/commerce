<?php
session_start();
include_once "connection.php";

// if user not logged in
if (!isset($_SESSION["logged_in"])) {
    header("Location: ../checkout.php?message=Please login/register to place an order");
    exit;
} else {
    if (isset($_POST['place_order'])) {
        //1. get user info and store in database
        $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_SPECIAL_CHARS);
        $city = filter_var($_POST['city'], FILTER_SANITIZE_SPECIAL_CHARS);
        $address = filter_var($_POST['address'], FILTER_SANITIZE_SPECIAL_CHARS);
        $order_cost = $_SESSION['total'];
        $order_status = "not paid";
        $user_id = $_SESSION['user_id'];
        $order_date = date('Y-m-d H:i:s');
        $stmt = $conn->prepare("INSERT INTO orders(
            order_cost, order_status, user_id, user_phone, user_city, user_address, order_date) 
        VALUES(?,?,?,?,?,?,?)");
        $stmt->bind_param("isiisss", $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);


        $stmt_status = $stmt->execute();

        if (!$stmt_status) {
            header("Location: index.php");
            exit;
        }

        //2. issue new order and store order info in database
        $order_id = $stmt->insert_id;

        //3. get products from cart (from session)
        foreach ($_SESSION['cart'] as $key => $value) {
            $product = $_SESSION['cart'][$key]; // []
            $product_id = $product['product_id'];
            $product_name = $product['product_name'];
            $product_image = $product['product_image'];
            $product_price = $product['product_price'];
            $product_quantity = $product['product_quantity'];

            // 4. store each single item in order_items database
            $stmt1 = $conn->prepare("INSERT INTO order_items(
                order_id, product_id, product_name, product_image,product_price, product_quantity, user_id, order_date)
            VALUES(?,?,?,?,?,?,?,?)");
            $stmt1->bind_param("iissiiis", $order_id, $product_id, $product_name, $product_image, $product_price, $product_quantity, $user_id, $order_date);

            $stmt1->execute();
        }

        // 5, remove everything from cart --> delay until payment is done
        unset($_SESSION['cart']);
        unset($_SESSION['quantity']);
        $_SESSION['order_id'] = $order_id;
        // 6. inform user wheter everything is fine or there is a problem
        header('Location: ../payment.php?order_status=order placed successfully');
    }
}

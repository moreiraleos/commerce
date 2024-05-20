<?php
require_once "../server/connection.php";

if (isset($_POST['edit_btn'])) {

    $product_id = filter_var($_POST['product_id'], FILTER_VALIDATE_INT);
    $title  = htmlspecialchars($_POST['product_name']);
    $description  = htmlspecialchars($_POST['product_description']);
    $price  = htmlspecialchars($_POST['product_price']);
    $offer  = htmlspecialchars($_POST['product_offer']);
    $color  = htmlspecialchars($_POST['product_color']);
    $category = htmlspecialchars($_POST['product_category']);

    $stmt1 = $conn->prepare("UPDATE products SET 
                      product_name=?, product_description=?, 
                      product_price=?, product_special_offer=?, product_color=?, product_category=?
                      WHERE product_id = ? LIMIT 1");
    $stmt1->bind_param("ssiissi", $title, $description, $price, $offer, $color, $category, $product_id);
    if ($stmt1->execute()) {
        header("Location: products.php?edit_success_message=Product has been updated sucessfully");
    } else {
        header("Location: products.php?edit_failure_message=Error occured, try again");
    }
}

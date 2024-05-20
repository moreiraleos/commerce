<?php
/*
    not paid
    shipped
    delivered
*/
session_start();
require_once "server/connection.php";

if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit;
}
if (isset($_POST['order_details_btn']) && isset($_POST['order_id'])) {
    $order_id = filter_var($_POST['order_id'], FILTER_VALIDATE_INT);
    $order_status = filter_var($_POST['order_status']);
    $stmt = $conn->prepare("SELECT product_name, product_price, product_image, product_quantity FROM order_items WHERE order_id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $order_items = $stmt->get_result();
    $order_total_price =  calculateTotalOrderPrice($order_items);
    if ($order_items->num_rows == 0) {
        header("Location: account.php");
    }
} else {
    header('Location: account.php');
}

function calculateTotalOrderPrice($orders)
{
    $total = 0;
    foreach ($orders as $row) {
        $product_price = $row["product_price"];
        $product_quantity = $row["product_quantity"];
        $total += ($product_price * $product_quantity);
    }
    return $total;
}
require_once "layouts/header.php";
?>
<!-- Order details -->
<section id="orders" class="orders container my-5 py-3">
    <div class="container mt-5">
        <h2 class="font-weight-bold text-center">Order details</h2>
        <hr class="mx-auto" />
    </div>
    <table class="mt-5 pt-5 mx-auto">
        <tr>
            <th>Product name</th>
            <th>Product price</th>
            <th>Quantity</th>
        </tr>
        <?php foreach ($order_items as $row) : ?>
            <tr>
                <td>
                    <div class="product-info">
                        <img src="assets/imgs/<?= $row["product_image"] ?>" alt="">
                        <div class="mt-3">
                            <span class="mt-5"><?= $row["product_name"] ?></span>
                        </div>
                    </div>
                </td>
                <td>
                    <span><?= $row["product_price"] ?></span>
                </td>
                <td>
                    <span><?= $row["product_quantity"]; ?></span>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php if ($order_status == "not paid") : ?>
        <form action="payment.php" method="POST" style="float: right;">
            <input type="hidden" name="order_id" value="<?= $order_id ?>">
            <input type="hidden" name="order_total_price" value="<?= $order_total_price ?>">
            <input type="hidden" name="order_status" value="<?= $order_status; ?>">
            <input type="submit" name="order_pay_button" class="btn btn-primary" value="Pay Now">
        </form>
    <?php endif; ?>
</section>
<!-- Footer -->
<?php
require_once "layouts/footer.php";
?>
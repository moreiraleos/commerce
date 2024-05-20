<?php
session_start();
if (isset($_POST["order_pay_button"])) {
    $order_status =  $_POST["order_status"];
    $order_total_price = $_POST["order_total_price"];
}
if (!isset($_SESSION["logged_in"])) {
    header("Location: index.php");
}
require_once "layouts/header.php";
?>
<!-- Payment -->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <?php if (isset($order_total_price) && $order_total_price != 0) : ?>
            <?php $amount = strval($order_total_price); ?>
            <?php $order_id = $_POST['order_id']; ?>
            <h2 class="form-weight-bold">Payment</h2>
            <hr class="mx-auto" />
    </div>
    <div class="mx-auto container text-center">
        <p>Total payment: $<?= $order_total_price; ?></p>
        <!-- <input class="btn btn-primary" value="Pay Now" type="submit"> -->
        <div style="display: inline-block;" id="paypal-button-container"></div>
    <?php elseif (isset($_SESSION["total"]) && $_SESSION["total"] != 0) : ?>
        <?php $amount = strval($_SESSION["total"]); ?>
        <?php $order_id = $_SESSION['order_id']; ?>
        <p>Total payment: $<?= $_SESSION["total"]; ?></p>
        <!-- <input class="btn btn-primary" value="Pay Now" type="submit"> -->
        <div style="display: inline-block;" id="paypal-button-container"></div>
    <?php else : ?>
        <p>You don't have an order</p>
    <?php endif; ?>

    </div>
</section>

<script src="https://www.paypal.com/sdk/js?client-id=AX7uNUrLFOy24x5SIJmDQcmuhBhO0wBoyjzkfxRDPAeWupSo-8NU7e1qQqUkUkXfvor_l9PnnfFNpVZZ&currency=BRL"></script>

<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?= $amount; ?>'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                var transaction = orderData.purchase_units[0].payments.captures[0];
                alert('Transaction ' + transaction.status + ': ' + transaction.id + '\n\nSee console for all ava');
                window.location.href = "server/complete_payment.php?transaction.id=" + transaction.id + "&order_id=" + <?= $order_id ?>;
            });
        }
    }).render('#paypal-button-container');
</script>
<!-- Footer -->
<?php
require_once "layouts/footer.php";
?>
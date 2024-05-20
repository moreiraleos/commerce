<?php
session_start();

// if (!empty($_SESSION['cart']) && isset($_POST['checkout'])) {
//   //let user in 
//   // send user to home page
// } else {

//   header("Location: index.php");
// }

if (empty($_SESSION['cart'])) {
  // send user to home page
  header("Location: index.php");
  exit;
}

require_once "layouts/header.php";
?>



<!-- Checkout -->
<section class="my-5 py-5">
  <div class="container text-center mt-3 pt-5">
    <h2 class="form-weight-bold">Check out</h2>
    <hr class="mx-auto" />
  </div>
  <div class="mx-auto container">
    <form id="checkout-form" method="post" action="server/place_order.php">
      <p class="text-center" style="color:red;">
        <?= $_GET["message"] ?? ""; ?>
        <?php if (isset($_GET["message"])) : ?>
          <a href="login.php" class="btn btn-primary">Login</a>
        <?php endif; ?>
      </p>
      <div class="form-group checkout-small-element">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Name" required />
      </div>
      <div class="form-group checkout-small-element">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="checkout-email" name="email" placeholder="E-mail" required />
      </div>
      <div class="form-group checkout-small-element">
        <label for="password">Phone</label>
        <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="Phone" required />
      </div>
      <div class="form-group checkout-small-element">
        <label for="password">City</label>
        <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City" required />
      </div>
      <div class="form-group checkout-large-element">
        <label for="password">Address</label>
        <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Address" required />
      </div>
      <div class="form-group checkout-btn-container">
        <p>Total amount: $<?= $_SESSION['total'] ?></p>
        <input type="submit" class="btn" id="checkout-btn" name="place_order" value="Place Order" />
      </div>
    </form>
  </div>
</section>

<?php
require_once "layouts/footer.php";
?>
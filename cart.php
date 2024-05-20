<?php

session_start();

// session_destroy();
// exit;
// if (!isset($_SESSION['logged_in'])) {
//   header("Location: index.php");
// }


if (isset($_POST["add_to_cart"])) {
  $product_id = filter_var($_POST['product_id'], FILTER_VALIDATE_INT);
  $product_name = filter_var($_POST['product_name'], FILTER_SANITIZE_SPECIAL_CHARS);
  $product_price = filter_var($_POST['product_price'], FILTER_SANITIZE_SPECIAL_CHARS);
  $product_image = filter_var($_POST['product_image'], FILTER_SANITIZE_SPECIAL_CHARS);
  $product_quantity = filter_var($_POST['product_quantity'], FILTER_VALIDATE_INT);

  // if user has already added a product to cart
  if (isset($_SESSION['cart'])) {
    $products_array_ids = array_column($_SESSION['cart'], "product_id"); // []
    // if product has already been addecto cart or not
    if (!in_array($product_id, $products_array_ids)) {
      $product_array = array(
        'product_id' => $product_id,
        'product_price' => $product_price,
        'product_name' => $product_name,
        'product_image' => $product_image,
        'product_quantity' => $product_quantity,
      );
      $_SESSION['cart'][$product_id] = $product_array;
      // prodcut as already been added
    } else {
      echo '<script>alert("Product was already to cart");</script>';
      // echo '<script>window.location="index.php";</script>';
    }
    // if this is the first product
  } else {
    $product_array = array(
      'product_id' => $product_id,
      'product_price' => $product_price,
      'product_name' => $product_name,
      'product_image' => $product_image,
      'product_quantity' => $product_quantity,
    );

    $_SESSION['cart'][$product_id] = $product_array;
    // [   ]
  }
  // calculate total
  calculateTotalCart();
  // var_dump($_SESSION);
  // exit;
}
// remove product from cart
else if (isset($_POST['remove_product']) && count($_SESSION['cart']) > 0) {
  $product_id = filter_var($_POST['product_id'], FILTER_VALIDATE_INT);
  unset($_SESSION['cart'][$product_id]);

  // calculate total
  calculateTotalCart();
}
// edit product quantity
else if (isset($_POST['edit_quantity'])) {
  if (isset($_POST['product_quantity'])) {
    // we get id and quantity from the form
    $product_id = filter_var($_POST['product_id'], FILTER_VALIDATE_INT);
    $product_quantity = filter_var($_POST['product_quantity'], FILTER_VALIDATE_INT);


    $_SESSION['cart'][$product_id]['product_quantity'] = $product_quantity;

    // calculate total
    calculateTotalCart();
  }
} else {
  // header("Location: index.php");
}
// if (empty($_SESSION)) {
//   header("Location: index.php");
// }
function calculateTotalCart()
{
  $total_price = 0;
  $total_quantity = 0;
  foreach ($_SESSION['cart'] as $key => $value) {
    // $total_price += ($value['product_quantity'] * $value['product_price']);
    // $total_price += ($product['product_quantity'] & $product['product_price']);
    $product = $_SESSION['cart'][$key];
    $price = $product['product_price'];
    $quantity = $product['product_quantity'];
    $total_price = $total_price + ($price * $quantity);
    $total_quantity += $quantity;
  }
  $_SESSION['total'] = $total_price;
  $_SESSION['quantity'] = $total_quantity;
  // return $total;
}
require_once "layouts/header.php";
?>

<!-- Cart -->
<section class="cart container my-5 py-5">
  <div class="container mt-5">
    <h2 class="font-weight-bold">Your Cart</h2>
    <hr />
  </div>
  <table class="mt-5 pt-5">
    <tr>
      <th>Product</th>
      <th>Quantity</th>
      <th>Subtotal</th>
    </tr>
    <!-- Products -->
    <?php
    //if (!empty($_SESSION['cart'])) : 
    ?>
    <?php if (isset($_SESSION['cart'])) : ?>
      <?php foreach ($_SESSION['cart'] as $key => $value) : ?>
        <tr>
          <td>
            <div class="product-info">
              <img src="assets/imgs/<?= $value['product_image']; ?>" alt="" />
              <div class="product-details">
                <p><?= $value['product_name']; ?></p>
                <small><span>$</span><?= $value['product_price']; ?></small>
                <br />
                <form method="post" action="cart.php">
                  <input type="hidden" name="product_id" value="<?= $value['product_id'] ?>">
                  <input type="submit" name="remove_product" href="#" class="remove-btn" value="Remove" />
                </form>
              </div>
            </div>
          </td>
          <td>
            <!-- Form quantity edit -->
            <form method="POST" action="cart.php">
              <input type="number" name="product_quantity" value="<?= $value['product_quantity']; ?>" min="1" />
              <input type="hidden" name="product_id" value="<?= $value["product_id"] ?>">
              <input type="submit" name="edit_quantity" value="Editar" class="edit-btn">
            </form>
          </td>
          <td>
            <span>$</span>
            <span class="product-price"><?= $value['product_price'] * $value['product_quantity'] ?></span>
          </td>
        </tr>
      <?php endforeach; ?>
      <!-- Products -->
  </table>
  <div class="cart-total">
    <table>
      <!-- <tr>
          <td>Subtotal</td>
          <td>$155</td>
        </tr> -->
      <tr>
        <td>Total</td>
        <td>$<?= $_SESSION['total'] ?? "" ?></td>
      </tr>
    </table>
  </div>

  <div class="checkout-container">
    <form method="post" action="checkout.php">
      <input type="submit" class="btn checkout-btn" name="checkout" value="Checkout" />
    </form>
  </div>
</section>

<?php endif; ?>
<!-- Footer -->
<?php
require_once "layouts/footer.php";
?>
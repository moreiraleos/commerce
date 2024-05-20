<?php
session_start();

require_once "server/connection.php";

if (!isset($_SESSION['logged_in'])) {
  header("Location: login.php");
  exit;
}

$user_id = filter_var($_SESSION['user_id'], FILTER_VALIDATE_INT);
$user_name = htmlspecialchars($_SESSION['user_name']);
$user_email = htmlspecialchars($_SESSION['user_email']);

// GET USER ORDERS
$stmt1 = $conn->prepare("SELECT order_id, order_cost, order_status, order_date
                        FROM orders WHERE user_id = ?");
$stmt1->bind_param("i", $user_id);
$stmt1->execute();
$orders = $stmt1->get_result();

if (isset($_GET['logout']) && $_GET['logout'] == 1) {
  unset($_SESSION['logged_in']);
  unset($_SESSION['user_email']);
  unset($_SESSION['user_name']);
  session_destroy();
  header("Location: login.php");
  exit;
}

if (isset($_POST['change_password_btn'])) {
  $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
  $confirm_password = filter_var($_POST['confirmPassword'], FILTER_SANITIZE_SPECIAL_CHARS);

  if ($password !== $confirm_password) {
    header("Location: account.php?error=passwords dont match");
  } else if (strlen($password) < 6) {
    header("Location: account.php?error=password must be at least 6 charachters");
  } else {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE users SET user_password = ? WHERE user_email = ?");
    $stmt->bind_param("ss", $password, $user_email);
    if ($stmt->execute()) {
      header("Location: account.php?message=password has been updated successfuly");
    } else {
      header("Location: account.php?message=could not update epasswod");
    }
  }
}

require_once "layouts/header.php";
?>


<!-- Account -->
<section class="my-5 py-5">
  <div class="row container mx-auto">
    <p style="color:green;" class="text-center mt-5"><?= $_GET['payment_message'] ?? "" ?></p>
    <p style="color:red;" class="text-center mt-5"><?= $_GET['error'] ?? "" ?></p>
    <p style="color:green;" class="text-center mt-5"><?= $_GET['message'] ?? "" ?></p>
    <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
      <p style="color:green;" class="text-center"><?= $_GET['register_success'] ?? "" ?></p>
      <h3 class="font-weight-bold">Account info</h3>
      <hr class="mx-auto" />
      <div class="account-info">
        <p>Name <span><?= $user_name ?? ""; ?></span></p>
        <p>Email <span><?= $user_email ?? ""; ?></span></p>
        <p><a href="#orders" id="orders-btn">Your orders</a></p>
        <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
      </div>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12">
      <form method="POST" id="account-form" action="account.php">

        <h3>Change Password</h3>
        <hr class="mx-auto" />
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="account-password" name="password" placeholder="Password" required />
        </div>
        <div class="form-group">
          <label for="confirmPassword">Confirm Password</label>
          <input type="password" class="form-control" id="account-password-confirm" name="confirmPassword" placeholder="confirmPassword" required />
        </div>
        <div class="form-group">
          <input type="submit" name="change_password_btn" class="btn" value="Change Password" id="change-pass-btn" />
        </div>
      </form>
    </div>
  </div>
</section>

<?php if ($orders->num_rows > 0) : ?>
  <!-- Orders -->
  <section id="orders" class="orders container my-5 py-3">
    <div class="container mt-2">
      <h2 class="font-weight-bold text-center">Your orders</h2>
      <hr class="mx-auto" />
    </div>
    <table class="mt-5 pt-5">
      <tr>
        <th>Order id</th>
        <th>Order cost</th>
        <th>Order status</th>
        <th>Order date</th>
        <th>Order details</th>
      </tr>
      <?php while ($row = $orders->fetch_object()) : ?>
        <tr>
          <td>
            <span>#<?= $row->order_id ?></span>
          </td>
          <td>
            <span><?= $row->order_cost ?></span>
          </td>
          <td><span><?= $row->order_status ?></span></td>
          <td>
            <span><?= date("d/m/Y", strtotime($row->order_date)) ?></span>
          </td>
          <td>
            <form method="POST" action="order_details.php">
              <input type="hidden" value="<?= $row->order_status ?>" name="order_status">
              <input type="hidden" name="order_id" value="<?= $row->order_id ?>">
              <input class="btn order-details-btn" name="order_details_btn" type="submit" value="Details">
            </form>
          </td>
        </tr>
      <?php endwhile; ?>


    </table>
  </section>
<?php endif; ?>
<!-- Footer -->
<?php
require_once "layouts/footer.php";
?>
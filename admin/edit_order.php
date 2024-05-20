<?php require_once "layout/header.php" ?>

<?php
if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: login.php");
  exit;
}

if (isset($_GET['order_id'])) {
  $order_id = filter_var($_GET['order_id'], FILTER_VALIDATE_INT);
  $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
  $stmt->bind_param("i", $order_id);
  $stmt->execute();

  $order = $stmt->get_result()->fetch_object();
} else {
  header('Location: products.php');
  exit;
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Dashboard</h1>
  <p class="mb-4">Edit Order.</p>
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <form action="edit_order_process.php" method="POST">


        <div class="form-group my-3">
          <label for="title">OrderId</label>
          <p class="my-4"><?= $order->order_id ?></p>
        </div>
        <div class="form-group mt-3">
          <label for="title">OrderPrice</label>
          <p class="my-4"><?= $order->order_cost ?></p>
        </div>

        <div class="form-group">
          <label for="title">Order Status</label>
          <select name="order_status" class="form-select">
            <option value="not paid" <?= ($order->order_status == 'not paid') ? "selected" : ""; ?>>Not paid</option>
            <option value="paid" <?= ($order->order_status == 'paid') ? "selected" : ""; ?>>Paid</option>
            <option value="shipped" <?= ($order->order_status == 'shipped') ? "selected" : ""; ?>>Shipped</option>
            <option value="delivered" <?= ($order->order_status == 'delivered') ? "selected" : ""; ?>>Delivered</option>
          </select>
        </div>

        <div class="form-group">
          <label for="title">OrderDate</label>
          <p class="my-4"><?= date("d/m/Y", strtotime($order->order_date)); ?></p>
        </div>
        <input type="hidden" value="<?= $order_id; ?>" name="order_id">
        <input type="submit" name="edit_btn" value="Edit" class="btn btn-primary">
      </form>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<?php require_once "layout/footer.php"; ?>
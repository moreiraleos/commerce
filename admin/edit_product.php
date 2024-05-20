<?php require_once "layout/header.php" ?>

<?php
if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: login.php");
  exit;
}

if (isset($_GET['product_id'])) {
  $product_id = filter_var($_GET['product_id'], FILTER_VALIDATE_INT);
  $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
  $stmt->bind_param("i", $product_id);
  $stmt->execute();

  $product = $stmt->get_result()->fetch_object();
} else {
  header('Location: products.php');
  exit;
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Dashboard</h1>
  <p class="mb-4">Edit Product.</p>
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <form action="edit_product_process.php" method="POST">
        <div class="form-group">
          <label for="title">Title</label>
          <input class="form-control" name="product_name" type="text" placeholder="Title" value="<?= $product->product_name ?>">
        </div>
        <div class="form-group">
          <label for="title">Description</label>
          <input class="form-control" type="text" name="product_description" placeholder="description" value="<?= $product->product_description ?>">
        </div>
        <div class="form-group">
          <label for="title">Price</label>
          <input class="form-control" type="text" name="product_price" placeholder="price" value="<?= $product->product_price ?>">
        </div>
        <div class="form-group">
          <label for="title">Category</label>
          <select name="product_category" id="" class="form-control">
            <option value="bags" <?= ($product->product_category == 'bags') ? "selected" : ""; ?>>Bags</option>
            <option value="shoes" <?= ($product->product_category == 'shoes') ? "selected" : ""; ?>>Shoes</option>
            <option value="coats" <?= ($product->product_category == 'coats') ? "selected" : ""; ?>>Coats</option>
            <option value="watches" <?= ($product->product_category == 'watches') ? "selected" : ""; ?>>Watches</option>
            <option value="shirt" <?= ($product->product_category == 'shirt') ? "selected" : ""; ?>>Shirt</option>
          </select>
        </div>
        <div class="form-group">
          <label for="title">Color</label>
          <input class="form-control" type="text" name="product_color" placeholder="color" value="<?= $product->product_color ?>">
        </div>
        <div class="form-group">
          <label for="title">Special Offer/Sale</label>
          <input class="form-control" type="text" name="product_offer" placeholder="Sale %" value="<?= $product->product_special_offer ?>">
        </div>
        <input type="hidden" value="<?= $product_id; ?>" name="product_id">
        <input type="submit" name="edit_btn" value="Edit" class="btn btn-primary">
      </form>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<?php require_once "layout/footer.php"; ?>
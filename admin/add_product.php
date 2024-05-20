<?php require_once "layout/header.php" ?>

<?php
if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: login.php");
  exit;
}


?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Dashboard</h1>
  <p class="mb-4">Add Product.</p>
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <form id="create-form" action="create_product.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label for="title">Title</label>
          <input class="form-control" name="product_name" type="text" placeholder="Title" value="<?= "" ?>">
        </div>
        <div class="form-group">
          <label for="title">Description</label>
          <input class="form-control" type="text" name="product_description" placeholder="description" value="<?= "" ?>">
        </div>
        <div class="form-group">
          <label for="title">Price</label>
          <input class="form-control" type="text" name="product_price" placeholder="price" value="<?= "" ?>">
        </div>
        <div class="form-group">
          <label for="title">Category</label>
          <select name="product_category" id="" class="form-control">
            <option value="bags">Bags</option>
            <option value="shoes">Shoes</option>
            <option value="coats">Coats</option>
            <option value="watches">Watches</option>
            <option value="shirt">Shirt</option>
          </select>
        </div>
        <div class="form-group">
          <label for="title">Color</label>
          <input class="form-control" type="text" name="product_color" placeholder="color" value="">
        </div>
        <div class="form-group mt-2">
          <label for="">Image 1</label>
          <input type="file" class="form-control" id="image1" name="image1" placeholder="Image 1" required>
        </div>

        <div class="form-group mt-2">
          <label for="">Image 2</label>
          <input type="file" class="form-control" id="image2" name="image2" placeholder="Image 2" required>
        </div>

        <div class="form-group mt-2">
          <label for="">Image 3</label>
          <input type="file" class="form-control" id="image3" name="image3" placeholder="Image 3" required>
        </div>

        <div class="form-group mt-2">
          <label for="">Image 4</label>
          <input type="file" class="form-control" id="image4" name="image4" placeholder="Image 4" required>
        </div>

        <div class="form-group">
          <label for="title">Special Offer/Sale</label>
          <input class="form-control" type="text" name="product_offer" placeholder="Sale %" value="">
        </div>

        <input type="submit" name="create_product" value="Add" class="btn btn-primary">
      </form>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<?php require_once "layout/footer.php"; ?>
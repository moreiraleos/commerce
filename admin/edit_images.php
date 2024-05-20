<?php require_once "layout/header.php" ?>

<?php
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $product_name = $_GET['product_name'];
} else {
    header('Location: products.php');
}

?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Dashboard</h1>
    <p class="mb-4">Add Product.</p>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <form id="create-form" action="update_images.php" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="product_id" value="<?= $product_id; ?>">
                <input type="hidden" name="product_name" value="<?= $product_name; ?>">

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

                <input type="submit" name="update_images" value="Add" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<?php require_once "layout/footer.php"; ?>
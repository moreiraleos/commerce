<?php require_once "layout/header.php" ?>

<?php
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

// GET PRODUCTS
// 1. determined page no
if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    // if user has already entered page then page number is the one that they selected
    $page_no = $_GET["page_no"];
} else {
    // if user just entered the page then default page is 1
    $page_no = 1;
}

// 2.return number of products
$stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM products");
$stmt1->execute();
$stmt1->bind_result($total_records);
$stmt1->store_result();
$stmt1->fetch();

// 3. products 
$total_records_per_page = 10;
$offset = ($page_no - 1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
// $adjacents = "2";
$total_no_of_pages = ceil($total_records / $total_records_per_page);

// 4.get all products
$stmt2 = $conn->prepare("SELECT * FROM products LIMIT {$offset},{$total_records_per_page}");
$stmt2->execute();
$products = $stmt2->get_result();
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Products</h1>
    <?php
    if (isset($_GET["edit_success_message"])) {
        echo "<p class='text-center' style='color:green'>" . $_GET['edit_success_message'] . "</p>";
    }
    if (isset($_GET["edit_failure_message"])) {
        echo "<p class='text-center' style='color:red'>" . $_GET['edit_failure_message'] . "</p>";
    }
    ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Product Id</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Product Offer</th>
                            <th>Product Category</th>
                            <th>Product Color</th>
                            <th>Edit Images</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Product Id</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Product Offer</th>
                            <th>Product Category</th>
                            <th>Product Color</th>
                            <th>Edit Images</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php while ($row = $products->fetch_object()) : ?>
                            <tr>
                                <td><?= $row->product_id ?></td>
                                <td><img style="width: 70px;" src="../assets/imgs/<?= $row->product_image ?>" alt=""></td>
                                <td><?= $row->product_name ?></td>
                                <td>R$<?= $row->product_price ?></td>
                                <td><?= $row->product_special_offer ?>%</td>
                                <td><?= $row->product_category ?></td>
                                <td><?= $row->product_color ?></td>
                                <td><a class="btn btn-warning" href="edit_images.php?product_id=<?= $row->product_id ?>&product_name=<?= $row->product_name ?>">Images</a></td>
                                <td><a class="btn btn-primary" href="edit_product.php?product_id=<?= $row->product_id ?>">Edit</a></td>
                                <td><a class="btn btn-danger" href="delete_product.php?product_id=<?= $row->product_id ?>">Delete</a></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination mt-5">
                    <li class="page-item <?= ($page_no <= 1) ? 'disabled' : ""; ?>">
                        <a class="page-link" href="<?= ($page_no <= 1) ? "#" : "?page_no=" . ($page_no - 1); ?>">Previous</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="?page_no=1">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="?page_no=2">2</a>
                    </li>
                    <?php if ($page_no >= 3) : ?>
                        <li class="page-item">
                            <a class="page-link" href="#">...</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?page_no=<?= $page_no ?>"><?= $page_no; ?></a>
                        </li>
                    <?php endif; ?>

                    <li class="page-item <?= ($page_no >= $total_no_of_pages) ? "disabled" : ""; ?>">
                        <a class="page-link" href="<?= ($page_no >= $total_no_of_pages) ? "#" : "?page_no=" . ($page_no + 1); ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </div>

    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php require_once "layout/footer.php"; ?>
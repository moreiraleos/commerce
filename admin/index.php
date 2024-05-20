<?php require_once "layout/header.php" ?>

<?php
if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: login.php");
  exit;
}

// GET USER ORDERS
// 1. determined page no
if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
  // if user has already entered page then page number is the one that they selected
  $page_no = $_GET["page_no"];
} else {
  // if user just entered the page then default page is 1
  $page_no = 1;
}

// 2.return number of products
$stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM orders");
$stmt1->execute();
$stmt1->bind_result($total_records);
$stmt1->store_result();
$stmt1->fetch();

// 3. products 
$total_records_per_page = 10;
$offset = ($page_no - 1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";
$total_no_of_pages = ceil($total_records / $total_records_per_page);

// 4.get all products
$stmt2 = $conn->prepare("SELECT * FROM orders LIMIT {$offset},{$total_records_per_page}");
$stmt2->execute();
$orders = $stmt2->get_result();
?>


<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Dashboard</h1>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
      <?php
      if (isset($_GET['edit_success_message'])) {
        echo "<p class='text-center' style='color:green;'>" . $_GET['edit_success_message'] . "</p>";
      } else if (isset($_GET['edit_failure_message'])) {
        echo "<p class='text-center' style='color:red;'>" . $_GET['edit_failure_message'] . "</p>";
      }
      ?>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Order Id</th>
              <th>order Status</th>
              <th>user ID</th>
              <th>Order Date</th>
              <th>User Phone</th>
              <th>User Address</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Order Id</th>
              <th>order Status</th>
              <th>user ID</th>
              <th>Order Date</th>
              <th>User Phone</th>
              <th>User Address</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </tfoot>
          <tbody>
            <?php while ($row = $orders->fetch_object()) : ?>
              <tr>
                <td><?= $row->order_id ?></td>
                <td><?= $row->order_status ?></td>
                <td><?= $row->user_id ?></td>
                <td><?= date("d/m/Y", strtotime($row->order_date)) ?></td>
                <td><?= $row->user_phone ?></td>
                <td><?= $row->user_address ?></td>
                <td><a class="btn btn-primary" href="edit_order.php?order_id=<?= $row->order_id ?>">Edit</a></td>
                <td><a class="btn btn-danger" href="delete_order.php?order_id=<?= $row->order_id ?>">Delete</a></td>
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
<?php
session_start();
require_once "server/connection.php";

// use the serch section
if (isset($_POST['search'])) {


  $category = htmlspecialchars($_POST['category']);
  $price = filter_var($_POST['price'], FILTER_VALIDATE_INT);
  // 1. determined page no
  if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    // if user has already entered page then page number is the one that they selected
    $page_no = $_GET["page_no"];
  } else {
    // if user just entered the page then default page is 1
    $page_no = 1;
  }

  // 2.return number of products
  $stmt1 = $conn->prepare("SELECT COUNT(*) FROM products WHERE product_category = ? aND product_price <= ?");
  $stmt1->bind_param("si", $category, $price);
  $stmt1->execute();
  $stmt1->bind_result($total_records);
  $stmt1->store_result();
  $stmt1->fetch();

  // 3. products 
  $total_records_per_page = 8;
  $offset = ($page_no - 1) * $total_records_per_page;
  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;
  $adjacents = "2";
  $total_no_of_pages = ceil($total_records / $total_records_per_page);

  // 4.get all products
  $stmt2 = $conn->prepare("SELECT * FROM products WHERE product_category = ? AND product_price <= ? LIMIT {$offset},{$total_records_per_page}");
  $stmt2->bind_param("si", $category, $price);
  $stmt2->execute();
  $products = $stmt2->get_result();

  // $stmt = $conn->prepare("SELECT * FROM products WHERE product_category = ? AND product_price <= ?");
  // $stmt->bind_param("si", $category, $price);
  // $stmt->execute();
  // $products = $stmt->get_result();
  // return all products 
} else {
  $category = "bags";
  // $stmt = $conn->prepare("SELECT * FROM products");
  // $stmt->execute();
  // $products = $stmt->get_result();

  // 1. determined page no
  if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    // if user has already entered page then page number is the one that they selected
    $page_no = $_GET["page_no"];
  } else {
    // if user just entered the page then default page is 1
    $page_no = 1;
  }

  // 2.return number of products
  $stmt1 = $conn->prepare("SELECT COUNT(*) as total_records FROM products");
  $stmt1->execute();
  $stmt1->bind_result($total_records);
  $stmt1->store_result();
  $stmt1->fetch();

  // 3. products 
  $total_records_per_page = 8;
  $offset = ($page_no - 1) * $total_records_per_page;
  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;
  $adjacents = "2";
  $total_no_of_pages = ceil($total_records / $total_records_per_page);

  // 4.get all products
  $stmt2 = $conn->prepare("SELECT * FROM products LIMIT {$offset},{$total_records_per_page}");
  $stmt2->execute();
  $products = $stmt2->get_result();
}

require_once "layouts/header.php";
?>

<div class="row">
  <div class="col-lg-3 col-md-3 col-sm-12">
    <!-- Search -->
    <section id="search" class="my-5 py-5 ms-2">
      <div class="container mt-5 py-5">
        <p>Search Products</p>
        <hr />
      </div>
      <form action="shop.php" method="POST">
        <div class="row mx-auto container">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <p>Category</p>
            <div class="form-check">
              <label for="category" class="form-check-label">
                <input type="radio" name="category" value="shoes" id="category_one" class="form-check-input" <?= (isset($category) && $category == "shoes") ? "checked" : ""; ?>>
                Shoes
              </label>
            </div>
            <div class="form-check">
              <label for="category" class="form-check-label">
                <input type="radio" name="category" value="coats" id="category_two" class="form-check-input" <?= (isset($category) && $category == "coats") ? "checked" : ""; ?>>
                Coats
              </label>
            </div>
            <div class="form-check">
              <label for="category" class="form-check-label">
                <input type="radio" name="category" value="watches" id="category_two" class="form-check-input" <?= (isset($category) && $category == "watches") ? "checked" : ""; ?>>
                Watches
              </label>
            </div>
            <div class="form-check">
              <label for="category" class="form-check-label">
                <input type="radio" name="category" value="bags" id="category_two" class="form-check-input" <?= (isset($category) && $category == "bags") ? "checked" : ""; ?>>
                Bags
              </label>
            </div>
          </div>
        </div>

        <div class="row mx-auto container mt-5">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <p>Price</p>
            <input type="range" class="form-range w-50" name="price" value="<?= $price ?? "100" ?>" min="1" max="1000" id="customRange2">
            <div class="w-50">
              <span style="float:left;">1</span>
              <span style="float:right;">1000</span>
            </div>
          </div>
        </div>
        <div class="form-group my-3 mx-3">
          <input type="submit" name="search" value="Search" class="btn btn-primary">
        </div>
      </form>
    </section>
  </div>
  <div class="col-lg-7 col-md-7 col-sm-12">
    <!-- Shop -->
    <section id="featured" class="my-5 py-5">
      <div class="container mt-5 py-5">
        <h3>Our Products</h3>
        <hr />
        <p>Here you can check out our featured products</p>
      </div>
      <div class="row mx-auto container">

        <?php while ($row = $products->fetch_object()) : ?>
          <!-- single product -->
          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img src="assets/imgs/<?= $row->product_image ?>" alt="" class="img-fluid mb-3" />
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name"><?= $row->product_name ?></h5>
            <h4 class="p-price"><?= $row->product_price ?></h4>
            <a class="btn shop-buy-btn" href="single_product.php?product_id=<?= $row->product_id ?>">Buy Now</a>
          </div>
          <!-- single product -->
        <?php endwhile; ?>

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
    </section>
  </div>
</div>



<!-- Footer -->
<?php
require_once "layouts/footer.php";
?>
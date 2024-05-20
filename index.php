<?php
session_start();
require_once "layouts/header.php";
?>

<!-- Home -->
<section id="home">
  <div class="container">
    <h5>NEW ARRIVALS</h5>
    <h1><span>Best Prices</span> This Season</h1>
    <p>Eshop offers the best products for the most affordable prices</p>
    <button>Shop Now</button>
  </div>
</section>

<!-- Brands -->
<section id="id" class="container">
  <div class="row">
    <img src="assets/imgs/brand1.jpg" alt="_" class="img-fluid col-lg-3 col-md-6 col-sm-12" />
    <img src="assets/imgs/brand2.jpg" alt="_" class="img-fluid col-lg-3 col-md-6 col-sm-12" />
    <img src="assets/imgs/brand3.jpg" alt="_" class="img-fluid col-lg-3 col-md-6 col-sm-12" />
    <img src="assets/imgs/brand4.jpg" alt="_" class="img-fluid col-lg-3 col-md-6 col-sm-12" />
  </div>
</section>

<!-- New -->
<section id="new" class="w-100">
  <div class="row p-0 m-0">
    <!-- One -->
    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
      <img class="img-fluid" src="assets/imgs/1.jpg" alt="" />
      <div class="details">
        <h2>Extreamely Awesome Shoes</h2>
        <button class="text-uppercase">Shop Now</button>
      </div>
    </div>
    <!-- Two -->
    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
      <img class="img-fluid" src="assets/imgs/2.jpg" alt="" />
      <div class="details">
        <h2>Awesome Jacket</h2>
        <button class="text-uppercase">Shop Now</button>
      </div>
    </div>
    <!-- Three -->
    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
      <img class="img-fluid" src="assets/imgs/3.jpg" alt="" />
      <div class="details">
        <h2>50% OFF</h2>
        <button class="text-uppercase">Shop Now</button>
      </div>
    </div>
  </div>
</section>

<!-- Featured -->
<section id="featured" class="my-5 py-5">
  <div class="container text-center mt-5 py-5">
    <h3>Our Featured</h3>
    <hr class="mx-auto" />
    <p>Here you can check out our featured products</p>
  </div>

  <div class="row mx-auto container-fluid">
    <?php while ($row = $featured_products->fetch_assoc()) : ?>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img src="assets/imgs/<?= $row["product_image"] ?>" alt="" class="img-fluid mb-3" />
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name"><?= $row["product_name"] ?></h5>
        <h4 class="p-price">R$<?= $row["product_price"] ?></h4>
        <a href="single_product.php?product_id=<?= $row["product_id"] ?>"><button class="buy-btn">Buy Now</button></a>
      </div>
    <?php endwhile; ?>


  </div>
</section>

<!-- Banner -->
<section id="banner" class="my-5 py-5">
  <div class="container">
    <h4>MID SEASON's SALE</h4>
    <h1>
      Autumn Collection <br />
      UP to 30% OFF
    </h1>
    <button class="text-uppercase">shop now</button>
  </div>
</section>

<!-- Clothes -->
<section id="clothes" class="my-5">
  <div class="container text-center mt-5 py-5">
    <h3>Dresses & Coats</h3>
    <hr class="mx-auto" />
    <p>Here you can check out our featured amazing clothes</p>
  </div>
  <div class="row mx-auto container-fluid">

    <?php while ($row = $coats_products->fetch_assoc()) : ?>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img src="assets/imgs/<?= $row["product_image"] ?>" alt="" class="img-fluid mb-3" />
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name"><?= $row["product_name"] ?></h5>
        <h4 class="p-price">R$<?= $row["product_price"] ?></h4>
        <a href="single_product.php?product_id=<?= $row["product_id"] ?>"><button class="buy-btn">Buy Now</button></a>
      </div>
    <?php endwhile; ?>


  </div>
</section>

<!-- watches -->
<section id="watches" class="my-5">
  <div class="container text-center mt-5 py-5">
    <h3>Watches</h3>
    <hr class="mx-auto" />
    <p>Here you can check out our unique watches</p>
  </div>
  <div class="row mx-auto container-fluid">

    <!-- single watch -->
    <?php while ($row = $watches_products->fetch_object()) : ?>
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
        <a href="single_product.php?product_id=<?= $row->product_id ?>"><button class="buy-btn">Buy Now</button></a>
      </div>
    <?php endwhile; ?>
    <!-- single watch -->

  </div>
</section>

<!-- Shoes -->
<section id="shoes" class="my-5">
  <div class="container text-center mt-5 py-5">
    <h3>Shoes</h3>
    <hr class="mx-auto" />
    <p>Here you can check out our amazing shoes</p>
  </div>
  <div class="row mx-auto container-fluid">

    <?php while ($row = $shoes_products->fetch_object()) : ?>
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
        <a href="single_product.php?product_id=<?= $row->product_id ?>"><button class="buy-btn">Buy Now</button></a>
      </div>
    <?php endwhile; ?>


  </div>
</section>

<!-- footer -->
<?php
require_once "layouts/footer.php";
?>
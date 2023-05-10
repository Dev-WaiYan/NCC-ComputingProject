<?php
$__cssLinks = ['styles/pages/home.css'];

$data = HomeController::getData();

?>

<main>
  <div class="banner">
    <div class="banner-text">
      <h1>Welcome to our Computer Accessories Shop</h1>
      <p>Shop our latest collection of computer accessories.</p>
      <a href="products" class="btn btn-primary">Shop Now</a>
    </div>
  </div>

  <div class="container my-4">
    <h2>Latest Products</h2>
    <div class="row">
      <?php
      foreach ($data->latestProducts as $value) {
      ?>

        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img class="card-img-top cover-img" src=<?php echo STORAGE_BASE_URL . '/' . $value['cover_img'] ?> alt="cover img">
            <div class="card-body">
              <h4 class="card-title"><?php echo $value['name'] ?></h4>
              <p class="card-text"><?php echo substr($value['short_description'], 0, 100) ?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-primary">View Details</button>
                  <button type="button" class="btn btn-sm ms-2 btn-primary">Reviews</button>
                </div>
                <small class="text-muted">USD - <?php echo $value['price'] ?></small>
              </div>
            </div>
          </div>
        </div>

      <?php }

      ?>
    </div>
    <div class="container text-center mb-4"><a href="products" class="btn btn-primary">Shop Now</a></div>
  </div>
</main>


<script>
  $(document).ready(function() {
    $('.banner-text').animate({
      opacity: 1
    }, 2000);
  });
</script>
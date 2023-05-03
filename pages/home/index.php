<?php
$__cssLinks = ['styles/pages/home.css'];

// $data = HomeController::getData();

?>

<main>
<div class="banner">
    <div class="banner-text">
        <h1>Welcome to our Computer Accessories Shop</h1>
        <p>Shop our latest collection of computer accessories.</p>
        <a href="#" class="btn btn-primary">Shop Now</a>
    </div>
</div>

<div class="container my-4">
  <h2>Latest Laptops</h2>
  <div class="row">
    <div class="col-md-4">
      <div class="card mb-4 shadow-sm">
        <img class="card-img-top" src="./media/img/banner/banner.jpg" alt="Product 1">
        <div class="card-body">
          <h4 class="card-title">Product 1</h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
              <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
              <button type="button" class="btn btn-sm btn-outline-secondary">Add to Cart</button>
            </div>
            <small class="text-muted">$19.99</small>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card mb-4 shadow-sm">
        <img class="card-img-top" src="./media/img/banner/banner.jpg" alt="Product 2">
        <div class="card-body">
          <h4 class="card-title">Product 2</h4>
          <p class="card-text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
              <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
              <button type="button" class="btn btn-sm btn-outline-secondary">Add to Cart</button>
            </div>
            <small class="text-muted">$29.99</small>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card mb-4 shadow-sm">
        <img class="card-img-top" src="./media/img/banner/banner.jpg" alt="Product 3">
        <div class="card-body">
          <h4 class="card-title">Product 3</h4>
          <p class="card-text">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti.</p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
              <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
              <button type="button" class="btn btn-sm btn-outline-secondary">Add to Cart</button>
            </div>
            <small class="text-muted">$39.99</small>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container text-center mb-4"><a href="#" class="btn btn-primary">Shop Now</a></div>
</div>

<div class="container my-4">
  <h2>Latest Accessories</h2>
  <div class="row">
    <div class="col-md-4">
      <div class="card mb-4 shadow-sm">
        <img class="card-img-top" src="./media/img/banner/banner.jpg" alt="Product 1">
        <div class="card-body">
          <h4 class="card-title">Product 1</h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
              <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
              <button type="button" class="btn btn-sm btn-outline-secondary">Add to Cart</button>
            </div>
            <small class="text-muted">$19.99</small>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card mb-4 shadow-sm">
        <img class="card-img-top" src="./media/img/banner/banner.jpg" alt="Product 2">
        <div class="card-body">
          <h4 class="card-title">Product 2</h4>
          <p class="card-text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
              <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
              <button type="button" class="btn btn-sm btn-outline-secondary">Add to Cart</button>
            </div>
            <small class="text-muted">$29.99</small>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card mb-4 shadow-sm">
        <img class="card-img-top" src="./media/img/banner/banner.jpg" alt="Product 3">
        <div class="card-body">
          <h4 class="card-title">Product 3</h4>
          <p class="card-text">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti.</p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
              <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
              <button type="button" class="btn btn-sm btn-outline-secondary">Add to Cart</button>
            </div>
            <small class="text-muted">$39.99</small>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container text-center mb-4"><a href="#" class="btn btn-primary">Shop Now</a></div>
</div>

</main>


<script>
    $(document).ready(function() {
        $('.banner-text').animate({
            opacity: 1
        }, 2000);
    });
</script>
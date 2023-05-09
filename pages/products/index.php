<?php
$__cssLinks = ['styles/pages/products.css'];

$data = ProductController::getData();

?>


<div class="container-fluid">
  <div class="row">
    <div class="col-md-3">
      <ul class="list-group sticky-top">
        <!-- <li class="list-group-item active">List Item 1</li> -->
        <?php foreach ($data->categories as $value) { ?>
          <a href='?category=<?php echo $value['id']; ?>'>
            <li class='list-group-item <?php echo (isset($_REQUEST['category']) && $_REQUEST['category'] == $value['id']) ? "active" : ""; ?>' style="text-transform: capitalize;"><?php echo $value['category_name']; ?></li>
          </a>
        <?php } ?>
      </ul>
    </div>
    <div class="col-md-9">
      <div class="container my-4">
        <h2><?php echo isset($_REQUEST['category']) ? '' : 'Latest' ?></h2>
        <div class="row">
          <?php
          if (isset($data->products)) {
          foreach ($data->products as $value) {
          ?>
            <div class="col-md-6">
              <div class="card mb-4 shadow-sm">
                <img class="card-img-top cover-img" src=<?php echo STORAGE_BASE_URL . '/' . $value['cover_img'] ?> alt="cover img">
                <div class="card-body">
                  <h4 class="card-title"><?php echo $value['name'] ?></h4>
                  <p class="card-text"><?php echo substr($value['short_description'], 0, 100) ?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">View Details</button>
                      <button type="button" class="btn btn-sm ms-2 btn-outline-secondary">Reviews</button>
                    </div>
                    <small class="text-muted">USD - <?php echo $value['price'] ?></small>
                  </div>
                </div>
              </div>
            </div>
          <?php
          }
        } else {
          ?>

          <h4 class="text-center text-info">No Products Found.</h4>
        
        <?php }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
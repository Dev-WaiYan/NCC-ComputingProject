<?php
$__cssLinks = ['styles/pages/product.css'];

$data = ProductController::getDetail();

$product = $data->product;

?>


<?php
if (isset($product)) {
  ?>
  <div class="container my-5">
    <div class="row">
        <div class="col-md-6 d-flex justify-content-center">
            <img class="cover-img" src="<?php echo STORAGE_BASE_URL . '/' . $product['cover_img'] ?>" alt="cover img">
        </div>
        <div class="col-md-6 mt-5 mt-md-0">
            <h2><?php echo $product['name'] ?></h2>
            <p class="price">USD <?php echo $product['price'] ?></p>
            <hr />
            <p><?php echo $product['short_description'] ?></p>
            <hr />
            <p><?php echo $product['description'] ?></p>
            <div>
                <input type="hidden" name="product_id" value="<?php echo $product['id'] ?>">
                <div class="form-group mb-5">
                    <label for="quantity">Quantity:</label>
                    <input type="number" name="quantity" class="form-control" value="1" min="1">
                </div>
                <div  class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
?>
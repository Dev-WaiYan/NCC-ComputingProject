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
                        <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1">
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-primary" onclick="addToCart()">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
        <?php if (isset($_SESSION['userId'])) { ?>
            <div class="row mt-5">
                <div class="col-md-8 offset-md-2">
                    <label for="feedbackReview">
                        Feedback for this item :
                    </label>
                    <textarea name="feedbackReview" id="feedbackReview" cols="30" rows="10" class="form-control" placeholder="Please give your review for this item."></textarea>
                    <div class="d-flex justify-content-end my-3"><button type="button" class="btn btn-primary" onclick="sendFeedback()">Send Feedback</button></div>
                </div>
            </div>
        <?php } ?>
    </div>
<?php
}
?>

<script>
    function showToast() {
        toast();
        document.getElementById('toastTitle').innerHTML = "New item added.";
        document.getElementById('toastBody').innerHTML = "<?php echo $product['name'] ?>" + " is added to cart.";
    }

    function addToCart() {
        const productId = "<?php echo $product['id'] ?>";
        const productName = "<?php echo $product['name'] ?>";
        const productCoverImg = "<?php echo $product['cover_img'] ?>";
        const productPrice = "<?php echo $product['price'] ?>";
        const quantity = $('#quantity').val();

        const session = "<?php echo isset($_SESSION['userId']) ? $_SESSION['userId'] : null ?>";

        if (!session) {
            window.location.href = "login?redirect=true";
        } else {
            showToast();
            const storedItemsString = sessionStorage.getItem('cart');
            let storedItems = [];
            if (storedItemsString) {
                const items = JSON.parse(storedItemsString)
                if (Array.isArray(items)) {
                    storedItems = items;
                }
            }
            const updatedItems = [...storedItems, {
                productId,
                productName,
                productPrice,
                productCoverImg,
                quantity
            }];
            $('#cart-count').text(updatedItems.length);

            sessionStorage.setItem('cart', JSON.stringify(updatedItems));
        }

        // if (email && password && userName && phone) {
        //     $.ajax({
        //         method: "POST",
        //         url: 'api/v1/register',
        //         data: {
        //             email,
        //             password,
        //             userName,
        //             phone
        //         },
        //         success: function(response) {
        //             if (response.existedUser) {
        //                 alert("Account has existed already.");
        //             } else {
        //                 alert("Successfully registered. Will redirect soon to login.");
        //             }

        //             setTimeout(() => {
        //                 window.location.replace('login')
        //             }, 1000)
        //         },
        //         error: function(xhr, status, error) {
        //             console.error(xhr);
        //             alert("Registration failed.");
        //         }
        //     });
        // } 

    }

    function sendFeedback() {
        const productId = <?php echo $product["id"] ?>;
        const feedback = $('#feedbackReview').val();

        if (feedback) {
            $.ajax({
                method: "POST",
                url: 'api/v1/feedback',
                data: {
                    feedbackReview : feedback,
                    productId
                },
                success: function(response) {
                    if (response.status === 'ok') {
                        alert("Successfully sended.");
                        $('#feedbackReview').val("");
                    } else {
                        throw new Error("Process failed.")
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                    alert("Process failed.");
                }
            });
        } else {
            alert("Please fill feedback.");
        }
    }
</script>
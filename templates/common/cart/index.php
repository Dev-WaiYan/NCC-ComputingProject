<div class="modal fade" id="cartModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Shopping Cart</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="cartTbody">
                    </tbody>
                </table>

                <div class="form-group my-3">
                    <label for="deliAddress" class="form-label">Delivery Address</label>
                    <input type="text" class="form-control" id="deliAddress">
                </div>

                <div class="form-group my-3">
                    <label for="paidReceipt" class="form-label">Paid Receipt</label>
                    <input type="file" class="form-control" id="paidReceipt">
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnCheckout" onclick="checkout()"></button>
            </div>

        </div>
    </div>
</div>


<script>
    let cartItems = [];
    let totalCheckoutPrice = 0;
    const tBody = document.getElementById('cartTbody');
    const btnCheckout = document.getElementById('btnCheckout');
    let receiptFile = null;

    $(document).ready(function() {
        $('#paidReceipt').on('change', function() {
            receiptFile = this.files[0];
        });
    });

    function defineCartItems(items) {
        tBody.innerHTML = "";
        totalCheckoutPrice = 0;
        items.forEach((item, index) => {
            console.log("item", item);
            totalCheckoutPrice += parseFloat(item.productPrice) * parseInt(item.quantity);
            tBody.innerHTML += `<tr>
              <td>${item.productName}</td>
              <td>$${item.productPrice}</td>
              <td>${item.quantity}</td>
              <td>$${parseFloat(item.productPrice) * parseInt(item.quantity)}</td>
              <td>
                <button type="button" class="btn btn-danger btn-sm" onclick="removeCartItem(${index})">Remove</button>
              </td>
            </tr>`;
        });

        btnCheckout.innerHTML = `Checkout - ${totalCheckoutPrice} USD`;
        $('#cart-count').text(items.length);
    }

    function removeCartItem(index) {
        cartItems.splice(index, 1);
        defineCartItems(cartItems);
        sessionStorage.setItem('cart', JSON.stringify(cartItems));
    }


    function viewCart() {
        const storedCartItems = sessionStorage.getItem('cart');
        if (storedCartItems) {
            cartItems = JSON.parse(storedCartItems);
        }
        defineCartItems(cartItems);
    }

    function checkout() {
        const deliAddress = $('#deliAddress').val();
        if (!receiptFile) {
            alert("Please upload your payment receipt.");
            return;
        }

        if (cartItems.length > 0 && deliAddress) {
            const formData = new FormData();
            formData.append('cartItems', JSON.stringify(cartItems));
            formData.append('deliAddress', deliAddress);
            formData.append('totalCheckoutPrice', totalCheckoutPrice);
            formData.append('paidReceipt', receiptFile);
            $.ajax({
                method: "POST",
                url: 'api/v1/checkout',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status === 'ok') {
                        alert("Successfully added.");
                        sessionStorage.clear();
                        window.location.reload();
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
            alert("Please fill required fields.");
        }
    }


    // Add an event listener to all remove buttons
    const removeButtons = document.querySelectorAll('.btn-danger');
    removeButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Get the table row that contains the clicked remove button
            var row = button.closest('tr');

            // Remove the table row
            row.remove();
        });
    });
</script>
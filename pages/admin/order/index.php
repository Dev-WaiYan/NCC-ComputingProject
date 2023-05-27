<?php
$__cssLinks = ['styles/pages/admin/order.css'];

$data = OrderController::getData();

?>

<main class="container-fluid">
    <h1 class="text-center my-3">Order Management</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">Order Id</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Customer Email</th>
                    <th scope="col">Customer Phone</th>
                    <th scope="col">Delivery Address</th>
                    <th scope="col">Receipt</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Payment Status</th>
                    <th scope="col">Delivery Status</th>
                    <th scope="col">Order Created At</th>
                    <th scope="col">Payment Confirm At</th>
                    <th scope="col">Operation</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data->orders as $value) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $value->order->id ?></th>
                        <td><?php echo $value->customer->name ?></td>
                        <td><?php echo $value->customer->email ?></td>
                        <td><?php echo $value->customer->phone ?></td>
                        <td><?php echo $value->order->deli_address ?></td>
                        <td><?php echo "<img src=" . STORAGE_BASE_URL . "/paid_receipts/" . $value->payment->payment_screen_shot . " class='img-fluid' style='max-width: 100px; max-height: 100px;' />" ?></td>
                        <td><?php echo $value->payment->totalCheckoutAmount ?></td>
                        <td><?php echo is_null($value->payment->is_payment_verified) ?  "<strong class='text-info'>Pending</strong>" : ($value->payment->is_payment_verified === 0 ? "<strong class='text-danger'>Rejected</strong>" : "<strong class='text-success'>Verified</strong>") ?></td>
                        <td><?php echo is_null($value->order->is_deliver_success) ? "<strong class='text-info'>Pending</strong>" : ($value->order->is_deliver_success === 0 ? "<strong class='text-danger'>Rejected</strong>" : "<strong class='text-success'>Success</strong>") ?></td>
                        <td><?php echo $value->order->created_at ?></td>
                        <td><?php echo $value->payment->payment_confirm_at ?></td>
                        <td>
                            <?php echo is_null($value->payment->is_payment_verified)  ? 
                            ('<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#paymentConfirmDecision" onclick="defineTarget(' . $value->order->id . "," . $value->payment->id . ')">Payment Action</button>')
                            : (is_null($value->order->is_deliver_success) ? '<button class="btn btn-outline-success mb-3" onclick="deliComplete(' . $value->order->id . ')">Delivery Complete</button>' :  ($value->order->is_deliver_success === 1 ? "<strong class='text-success'>Completed</strong>" : "<strong class='text-danger'>Rejected</strong>")) ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- form utils -->
    <input type="hidden" id="targetOrderId" />
    <input type="hidden" id="targetPaymentId" />
</main>

<!-- Modal -->
<div class="modal fade" id="paymentConfirmDecision" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Payment Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group d-flex justify-content-center">
                        <button type="button" class="btn btn-outline-success m-3" onclick="orderAccept(true)">Accept</button>
                        <button type="button" class="btn btn-danger m-3" onclick="orderAccept(false)">Reject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function defineTarget(orderId, paymentId) {
        $('#targetOrderId').val(orderId);
        $('#targetPaymentId').val(paymentId);
    }

    function deliComplete(orderId) {
        if (orderId) {
            $.ajax({
                method: "POST",
                url: `api/v1/deliComplete`,
                data : {
                    orderId,
                },
                success: function(response) {
                    if (response.status === 'ok') {
                        alert("Successfully updated.");
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
            alert("Something wrong.");
        }
    }

    function orderAccept(decision) {
        const orderId = $('#targetOrderId').val();
        const paymentId = $('#targetPaymentId').val();
        if (orderId && paymentId) {
            $.ajax({
                method: "POST",
                url: `api/v1/paymentDecision`,
                data : {
                    orderId,
                    paymentId,
                    decision : decision ? 1 : 0
                },
                success: function(response) {
                    if (response.status === 'ok') {
                        alert("Successfully updated.");
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
            alert("Something wrong.");
        }
    }
</script>
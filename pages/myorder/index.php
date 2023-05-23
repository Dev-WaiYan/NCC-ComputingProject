<?php
$__cssLinks = ['styles/pages/home.css'];

$data = MyOrderController::getData();
?>

<main class="container">
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">Order Id</th>
                    <th scope="col">Total Paid Amount</th>
                    <th scope="col">Paid Receipt</th>
                    <th scope="col">Payment Status</th>
                    <th scope="col">Delivery Status</th>
                    <th scope="col">Order Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data->myOrders as $value) { ?>
                    <tr>
                        <th scope="row"><?php echo $value->order['id'] ?></th>
                        <td><?php echo $value->payment['totalCheckoutAmount'] ?></td>
                        <td><?php echo "<img src=" . STORAGE_BASE_URL . "/paid_receipts/" . $value->payment['payment_screen_shot'] . " class='img-fluid' style='max-width: 200px; max-height: 200px;' />" ?></td>
                        <td><?php echo $value->payment['is_payment_verified'] === 0 ? "<strong class='text-danger'>Pending</strong>" : "<strong class='text-success'>Verified</strong>" ?></td>
                        <td><?php echo $value->order['is_deliver_success'] === 0 ? "<strong class='text-danger'>Pending</strong>" : "<strong class='text-success'>Success</strong>" ?></td>
                        <td><?php echo $value->order['created_at'] ?></td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
</main>
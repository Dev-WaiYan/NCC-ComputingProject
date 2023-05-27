<?php
$__cssLinks = ['styles/pages/admin/order.css'];

$data = ReportController::getData();

?>

<main class="container-fluid">
    <h1 class="text-center my-3">Income Report</h1>
    <div class="row my-5">
        <div class="col-md-3 my-2">
            <div class="form-group">
                <label for="paymentStatus">
                    Payment Status
                </label>
                <select class="form-control" id="paymentStatus">
                    <option value="">All</option>
                    <option value="null">Pending</option>
                    <option value="0">Rejected</option>
                    <option value="1">Verified</option>
                </select>
            </div>
        </div>
        <div class="col-md-4 my-2">
            <div class="form-group">
                <label for="orderStartDate">
                    Order Create Start Date
                </label>
                <input type="date" id="orderStartDate" class="form-control" />
            </div>
        </div>
        <div class="col-md-4 my-2">
            <div class="form-group">
                <label for="orderEndDate">
                    Order Create End Date
                </label>
                <input type="date" id="orderEndDate" class="form-control" />
            </div>
        </div>
        <div class="col-md-1 my-2 d-flex align-items-end justify-content-center">
            <div class="form-group">
                <button onclick="filter()" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <caption>Total Income : <strong class="text-info" id="totalCalculatedIncome"><?php echo $data->totalCalculatedIncome ?></strong> USD</caption>
            <thead>
                <tr>
                    <th scope="col">Order Id</th>
                    <th scope="col">Payment Status</th>
                    <th scope="col">Income</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <?php
                foreach ($data->orders as $value) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $value->order->id ?></th>
                        <td><?php echo is_null($value->payment->is_payment_verified) ?  "<strong class='text-info'>Pending</strong>" : ($value->payment->is_payment_verified === 0 ? "<strong class='text-danger'>Rejected</strong>" : "<strong class='text-success'>Verified</strong>") ?></td>
                        <td><?php echo $value->payment->totalCheckoutAmount ?></td>
                        <td><?php echo $value->order->created_at ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</main>

<script>
    function filter() {
        const paymentStatus = $('#paymentStatus').val();
        const orderStartDate = $('#orderStartDate').val();
        const orderEndDate = $('#orderEndDate').val();

        $.ajax({
            method: "POST",
            url: `api/v1/report`,
            data: {
                paymentStatus,
                orderStartDate,
                orderEndDate
            },
            success: function(response) {
                if (response.status === 'ok') {
                    console.log("response", response)
                    const {
                        orders,
                        totalCalculatedIncome
                    } = response.result;
                    $('#totalCalculatedIncome').html(totalCalculatedIncome);
                    let tbody = ""

                    if (orders.length > 0) {
                        orders.forEach(value => {
                            tbody += `<tr>
                                <th scope="row">${value.order.id}</th>
                                <td>${value.payment.is_payment_verified === null ?  "<strong class='text-info'>Pending</strong>" : (value.payment.is_payment_verified === 0 ? "<strong class='text-danger'>Rejected</strong>" : "<strong class='text-success'>Verified</strong>")}</td>
                                <td>${value.payment.totalCheckoutAmount}</td>
                                <td>${value.order.created_at}</td>
                            </tr>`;
                        })
                    }

                    $('#tbody').html(tbody);
                } else {
                    throw new Error("Process failed.")
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr);
                alert("Process failed.");
            }
        });

    }
</script>
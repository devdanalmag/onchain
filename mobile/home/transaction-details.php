<div class="page-content header-clear-medium">

    <div class="card card-style">
        <div class="content">
            <?php if ($data->status == 0 || $data->status == 2) { ?>
                <div class="text-center"><img src="../../assets/images/icons/success.png"
                        style="width:100px; height:100px;" /></div><?php } else { ?>
                <div class="text-center"><img src="../../assets/images/icons/failed.png"
                        style="width:200px; height:200px;" /></div><?php } ?>
            <p class="mb-0 font-600 color-highlight text-center">Transaction Details</p>
            <h1 class="text-center">Transaction
                <?php if ($data->status == 0) {
                    echo "Successful";
                } elseif ($data->status == 2) {
                    echo "Processing";
                } else {
                    echo "Failed";
                } ?>
            </h1>
            <table class="table table-bordered table-striped">
                <tr>
                    <td><b>Transaction No:</b></td>
                    <td><?php echo $data->transref; ?></td>
                </tr>
                <tr>
                    <td><b>Service:</b></td>
                    <td><?php echo $data->servicename; ?></td>
                </tr>
                <tr>
                    <td><b>Description:</b></td>
                    <td><?php echo $data->servicedesc; ?></td>
                </tr>
                <?php if (!isset($_GET["receipt"])): ?>
                    <tr>
                        <td><b>Amount:</b></td>
                        <td>N<?php echo $data->amount; ?></td>
                    </tr>
                    <tr>
                        <td><b>Old Balance:</b></td>
                        <td>N<?php echo $data->oldbal; ?></td>
                    </tr>
                    <tr>
                        <td><b>New Balance:</b></td>
                        <td>N<?php echo $data->newbal; ?></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td><b>Status:</b></td>
                    <td><?php echo $controller->formatStatus($data->status); ?></td>
                </tr>
                <tr>
                    <td><b>Date:</b></td>
                    <td><?php echo $controller->formatDate($data->date); ?></td>
                </tr>


            </table>
            <?php if (!isset($_GET["receipt"])): ?>
                <a href="transaction-details?receipt&ref=<?php echo $_GET["ref"]; ?>" class="btn btn-success btn-sm">
                    <b>View User Receipt</b>
                </a>
            <?php endif; ?>
            <?php if ($data->servicename == "Data Pin" && $data->status == 0): ?>
                <a href="view-pins?ref=<?php echo $_GET["ref"]; ?>" style="margin-left:15px;"
                    class="btn btn-primary btn-sm">
                    <b>View Pins</b>
                </a>
            <?php endif; ?>
        </div>

    </div>

</div>
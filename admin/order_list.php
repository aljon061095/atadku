<?php
require_once "includes/config.php";

$order_sql = "SELECT * FROM orders";
$result = mysqli_query($link, $order_sql);
$order_list = $result->fetch_all(MYSQLI_ASSOC);

if (isset($_POST["ExportType"])) {
    if (isset($_POST['from_date']) && isset($_POST['to_date'])) {
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];

        $query = "SELECT * FROM orders where date_created between '" . $from_date . "' 
            and '" . $to_date . "' ORDER BY id asc";
        $result = mysqli_query($link, $query);
        $order_list = $result->fetch_all(MYSQLI_ASSOC);
    }

    $filename = "Order_List" . ".xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    ExportFile($order_list);
    exit();
}

function ExportFile($records)
{
    $heading = false;
    if (!empty($records))
        foreach ($records as $row) {
            if (!$heading) {
                // display field/column names as a first row
                echo implode("\t", array_keys($row)) . "\n";
                $heading = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<link href="../vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
<?php include 'includes/header.php' ?>
<!-- Datatable -->

<body>

    <?php include 'includes/preloader.php' ?>

    <div id="main-wrapper">

        <?php include 'includes/topbar.php' ?>
        <?php include 'includes/sidebar.php' ?>

        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4><i class="mdi mdi-navigation"></i> Order List</h4>
                            <div class="col-md-12 float-right mb-4">
                                <div class="btn-group pull-right">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#exportModal" class="btn fs-22 py-1 ml-2 btn-primary">
                                        <i class="mdi mdi-download"></i>
                                        Export
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Order Code</th>
                                                <th>Customer</th>
                                                <th>Item or Food</th>
                                                <th>Delivery Charge</th>
                                                <th>Order Details</th>
                                                <th>Total Amount</th>
                                                <th>Driver</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($order_list as $order) { ?>
                                                <?php
                                                    $customer_id = $order['customer_id'];;
                                                    $result = mysqli_query($link, "SELECT *
                                                                    FROM customer WHERE id = $customer_id");
                                                    $row = mysqli_fetch_array($result);
                                                ?>
                                                <?php if ($row != "") { ?>
                                                    <tr>
                                                        <td>
                                                            <a href="order_info.php?order_id=<?php echo $order['id']; ?>">
                                                                <?php echo $order['order_id']; ?>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['full_name']; ?>
                                                        </td>
                                                        <td><?php echo $order['name']; ?></td>
                                                        <td>49.00</td>
                                                        <td><?php echo date('m-d-Y H:i A', strtotime($order['order_date'])); ?></td>
                                                        <td><?php echo number_format($order['total'] > 0 ? $order['total'] : 0  + 49, 2); ?></td>
                                                        <td>
                                                            <?php
                                                            $driver_id = $order['driver_id'];
                                                            $result = mysqli_query($link, "SELECT *
                                                                    FROM driver WHERE id = $driver_id");
                                                            $driver = mysqli_fetch_array($result);
                                                            ?>
                                                            <?php echo $driver != null ? $driver['full_name']  : "No assigned driver yet."; ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($order['status'] == 2) { ?>
                                                                <span class="badge light badge-info">
                                                                    <i class="fa fa-circle text-info mr-1"></i>
                                                                    ready for delivery
                                                                </span>
                                                            <?php } else if ($order['status'] == 3) { ?>
                                                                <span class="badge light badge-success">
                                                                    <i class="fa fa-circle text-success mr-1"></i>
                                                                    delivered
                                                                </span>
                                                            <?php } else { ?>
                                                                <span class="badge light badge-warning">
                                                                    <i class="fa fa-circle text-warning mr-1"></i>
                                                                    pending
                                                                </span>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Food List -->
    <div class="modal fade" id="addStoreModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add Item</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" name="store" id="store" placeholder="Store Name">
                                <label for="store">Store</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" name="item_name" id="item_name" placeholder="Item Name">
                                <label for="item_name">Item Name</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-floating mb-2">
                                <input type="number" class="form-control" name="price" id="price" placeholder="Price">
                                <label for="price">Price</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-floating mb-2">
                                <input type="file" class="form-control" name="image" id="image" placeholder="Imgae">
                                <label for="image">Image</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-floating mb-2">
                                <textarea class="form-control" placeholder="Description" name="description" id="description"></textarea>
                                <label for="description">Description</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="save_item" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include 'export_modal.php' ?>
    <?php include 'includes/footer.php' ?>
    <script type="text/javascript">
        $(document).ready(function() {
            jQuery('button').on("click", function() {
                var target = $(this).attr('id');
                switch (target) {
                    case 'export-to-excel':
                        $('#hidden-type').val(target);
                        //alert($('#hidden-type').val());
                        $('#export-form').submit();
                        $('#hidden-type').val('');
                        break;
                }
            });
        });
    </script>


</body>

</html>
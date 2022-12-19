<?php
//Include config file
require_once "includes/config.php";

//Initialize the session
session_start();

$restaurant_id = $_SESSION["id"];
$orders_sql = "SELECT * FROM orders WHERE restaurant_id = $restaurant_id";
$result = mysqli_query($link, $orders_sql);
$orders = $result->fetch_all(MYSQLI_ASSOC);
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
                            <h4><i class="mdi mdi-cart-plus"></i> Order List</h4>
                        </div>
                    </div>
                </div>
                <!-- <pre>
                    <?php print_r($orders); ?>
                </pre> -->
                <div class="row">
                    <?php
                    if (isset($_SESSION['success_status'])) {
                    ?>
                        <div class="alert alert-success alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <?php echo $_SESSION['success_status']; ?>
                        </div>
                    <?php
                        unset($_SESSION['success_status']);
                    }
                    ?>
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
                                                <th>Date</th>
                                                <th>Food</th>
                                                <th>Charge</th>
                                                <th>Total Amount</th>
                                                <th>Driver</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($orders as $order) { ?>
                                                <tr>
                                                    <td>
                                                        <a href="order_info.php?order_id=<?php echo $order['id']; ?>">
                                                            <?php echo $order['order_id']; ?>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            $customer_id = $order['customer_id'];
                                                            $result = mysqli_query($link, "SELECT *
                                                                    FROM customer WHERE id = $customer_id");
                                                            $row = mysqli_fetch_array($result);
                                                            ?>
                                                        <?php echo $row['full_name']; ?>
                                                    </td>
                                                    <td><?php echo date('m-d-Y', strtotime($order['order_date'])); ?></td>
                                                    <td><?php echo $order['name']; ?></td>
                                                    <td>49.00</td>
                                                    <td><?php echo number_format($order['total'] > 0 ? $order['total'] : 0  + 49, 2); ?></td>
                                                    <td>
                                                        <?php
                                                            $driver_id = $order['driver_id'];
                                                            $result = mysqli_query($link, "SELECT *
                                                                    FROM driver WHERE id = $driver_id");
                                                            $driver = mysqli_fetch_array($result);
                                                        ?>
                                                        <?php echo $driver != null ? $driver['full_name']  : "No assigned driver yet." ; ?>
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
                                            <?php } ?>
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
    <?php include 'includes/feedbacks.php' ?>
    <?php include 'includes/footer.php' ?>

</body>

</html>
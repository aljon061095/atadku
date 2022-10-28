<?php
require_once "includes/config.php";

//session start
session_start();

if (isset($_POST['approved'])) {
    $id = $_POST['order_id'];
    $driver_id = $_POST['driver_id'];
    $driver_name = $_POST['driver_name'];
    $status = 2;

    $query = "UPDATE `food_orders` SET `driver_id` = $driver_id, `status` = $status WHERE id = $id";
    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        //update the order status -- assigned driver
        $description = "Your order is now approved. Your delivery rider is  $driver_name. Thank you!";

        $query_status = "INSERT INTO order_status(order_id, description)
            VALUES ('$id', '$description')";
        $query_status_run = mysqli_query($link, $query_status);

        $_SESSION['success_status'] = "You have successfully updated the status of the item.";
        header("location: order_list.php");
    }
}

$order_id = $_GET['order_id'];
$order_sql = "SELECT * FROM food_orders WHERE id = $order_id";
$result = mysqli_query($link, $order_sql);
$order = $result->fetch_array(MYSQLI_ASSOC);

$driver_sql = "SELECT * FROM driver";
$driver_result = mysqli_query($link, $driver_sql);
$drivers = $driver_result->fetch_all(MYSQLI_ASSOC);
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
                            <h4><i class="mdi mdi-cart-plus"></i> Order Information</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="form-floating mb-2">
                                                <input type="text" class="form-control" value="<?php echo $order["order_id"]; ?>" name="order_id" id="order_id" placeholder="Pickup Code" readonly>
                                                <label for="price">Order Code</label>
                                            </div>
                                        </div>
                                        <?php
                                            $customer_id = $order['customer_id'];;
                                            $result = mysqli_query($link, "SELECT *
                                                    FROM customer WHERE id = $customer_id");
                                            $row = mysqli_fetch_array($result);
                                        ?>
                                        <div class="form-group">
                                            <div class="form-floating mb-2">
                                                <input type="text" class="form-control" name="customer" value="<?php echo $row['full_name']; ?>" id="customer" placeholder="Customers" readonly>
                                                <label for="customer">Customer</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-floating mb-2">
                                                <input type="text" class="form-control" value="<?php echo $order["name"]; ?>" name="name" id="name" placeholder="Item or Food" readonly>
                                                <label for="name">Item or Food</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-floating mb-2">
                                                <input type="number" class="form-control" value="49.00" name="charge" id="charge" placeholder="Delivery Charge" readonly>
                                                <label for="charge">Delivery Charge</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="form-floating mb-2">
                                                <input type="text" class="form-control" value="<?php echo $order['payment_method']; ?>" name="payment_method" id="payment_method" placeholder="Email" readonly>
                                                <label for="payment_method">Payment Method</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-floating mb-2">
                                                <input type="text" class="form-control" value="<?php echo $order['account_name']; ?>" placeholder="Account Name" name="account_name" id="account_name" readonly>
                                                <label for="account_name">Account Name</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-floating mb-2">
                                                <input type="number" class="form-control" value="<?php echo $pickup['account_number']; ?>" placeholder="Account Number" name="account_number" id="account_number" readonly>
                                                <label for="account_number">Account Number</label>
                                            </div>
                                        </div>
                                        <?php if ($order['status'] == 1) { ?>
                                            <div class="form-group">
                                                <div class="form-floating">
                                                    <select class="form-select" id="driver" name="driver" required>
                                                        <option selected value="">Select Driver</option>
                                                        <?php foreach ($drivers as $driver) { ?>
                                                            <option value="<?php echo $driver['id']; ?>"><?php echo $driver['full_name']; ?></option>
                                                        <?php  } ?>
                                                    </select>
                                                    <label for="driver_id"></label>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <?php
                                                $driver_id = $order['driver_id'];
                                                $result = mysqli_query($link, "SELECT *
                                                        FROM driver WHERE id = $driver_id");
                                                $driver = mysqli_fetch_array($result);
                                            ?>
                                            <div class="form-group">
                                                <div class="form-floating mb-2">
                                                    <input type="text" class="form-control" value=" <?php echo $driver != null ? $driver['full_name']  : "No assigned driver yet." ; ?>" placeholder="Delivery Rider" name="driver" id="driver" readonly>
                                                    <label for="driver">Delivery Rider</label>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="float-right">
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />
                                        <input type="hidden" id="driver_id" name="driver_id" />
                                        <input type="hidden" id="driver_name" name="driver_name" />
                                        <button type="submit" name="approved" class="btn btn-success <?php echo $order['status'] == 2 ? "disabled": ""?>">Approved</button>
                                        <button type="submit" name="reject" class="btn btn-danger <?php echo $order['status'] == 2 ? "disabled": ""?>">Reject</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include 'includes/footer.php' ?>

    <script>
        $('#driver').on('change', function(e) {
            var $driver_id = $(e.currentTarget).find(":selected").val();
            var $driver_name = $(e.currentTarget).find(":selected").text();
            $('#driver_id').val($driver_id);
            $('#driver_name').val($driver_name);
        });
    </script>

</body>

</html>
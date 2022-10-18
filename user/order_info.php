<?php
//Include config file
require_once "includes/config.php";

//Initialize the session
session_start();

$restaurant_id = $_SESSION["id"];
$order_id = $_GET["order_id"];
$orders_sql = "SELECT * FROM food_orders WHERE restaurant_id = $restaurant_id && id = $order_id";
$result = mysqli_query($link, $orders_sql);
$order = $result->fetch_array(MYSQLI_ASSOC);

if (isset($_POST['ready_for_delivery'])) {
    $id = $_POST['order_id'];

    $query = "UPDATE `food_orders` SET `status` = 2 WHERE id = $id";
    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        $_SESSION['success_status'] = "You have successfully updated the status of the delivery";
        header("location: order_restaurant.php");
    }
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

        <div class="content-body" style="margin-left: -5px; padding-top: 5rem;">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4><i class="mdi mdi-cart-plus"></i> Order Info</h4>
                            <div class="pull-right">
                                <form action="order_info.php?order_id=<?php echo $order_id; ?>" method="POST">
                                    <input type="text" name="order_id" value="<?php echo $order["id"]; ?>" />
                                    <button type="submit" name="ready_for_delivery" class="btn btn-success">Ready for Delivery</button>
                                    <button type="submit" name="reject" class="btn btn-danger">Reject</button>
                                </form>
                            </div>
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
                                                <input type="number" class="form-control" value="<?php echo $order["order_id"]; ?>" name="order_id" id="order_id" placeholder="order_id" readonly>
                                                <label for="price">Order Id</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-floating mb-2">
                                                <input type="text" class="form-control" name="food_name" value="<?php echo $order["name"]; ?>" id="food_name" placeholder="Food Name" readonly>
                                                <label for="food_name">Food Name</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-floating mb-2">
                                                <input type="number" class="form-control" value="<?php echo $order["price"]; ?>" name="price" id="price" placeholder="Price" readonly>
                                                <label for="price">Price</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-floating mb-2">
                                                <input type="number" class="form-control" value="<?php echo $order["quantity"]; ?>" name="quantity" id="quantity" placeholder="Quantity" readonly>
                                                <label for="quantity">Quantity</label>
                                            </div>
                                        </div>
                                        <?php
                                        $driver_id = $order['driver_id'];;
                                        $result = mysqli_query($link, "SELECT *
                                                    FROM driver WHERE id = $driver_id");
                                        $driver = mysqli_fetch_array($result);
                                        ?>
                                        <div class="form-group">
                                            <div class="form-floating mb-2">
                                                <input type="text" class="form-control" value="<?php echo $driver['full_name']; ?>" name="driver" id="driver" placeholder="Driver" readonly>
                                                <label for="driver">Driver</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-floating mb-2">
                                                <input type="text" class="form-control" value="<?php echo $driver['number']; ?>" placeholder="Driver's Contact Number" name="driver_contact" id="driver_contact" readonly>
                                                <label for="driver_contact">Driver's Contact Number</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <?php
                                        $customer_id = $order['customer_id'];;
                                        $result = mysqli_query($link, "SELECT *
                                                    FROM customer WHERE id = $customer_id");
                                        $row = mysqli_fetch_array($result);
                                        ?>
                                        <div class="form-group">
                                            <div class="form-floating mb-2">
                                                <input type="text" class="form-control" name="customer_name" value=" <?php echo $row['full_name']; ?>" id="food_name" placeholder="Food Name" readonly>
                                                <label for="food_name">Customer Name</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-floating mb-2">
                                                <input type="number" class="form-control" value="<?php echo $row['number']; ?>" name="number" id="number" placeholder="number" readonly>
                                                <label for="number">Contact Number</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-floating mb-2">
                                                <input type="email" class="form-control" value="<?php echo $row['email_address']; ?>" name="email" id="email" placeholder="Email" readonly>
                                                <label for="email">Email</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-floating mb-2">
                                                <input type="text" class="form-control" value="<?php echo $row['address']; ?>" placeholder="Address" name="address" id="address" readonly>
                                                <label for="address">Address</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-floating mb-2">
                                                <input type="text" class="form-control" value="<?php echo $row['username']; ?>" placeholder="Username" name="username" id="username" readonly>
                                                <label for="username">Username</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-floating mb-2">
                                                <input type="text" class="form-control" value="<?php echo $order['order_date']; ?>" placeholder="Order Date" name="order_date" id="order_date" readonly>
                                                <label for="order_date">Order Date</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php' ?>

</body>

</html>
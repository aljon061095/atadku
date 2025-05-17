<?php
require_once "includes/config.php";

session_start();

$driver_id = $_SESSION['id'];
$driver_sql = "SELECT * FROM driver WHERE id = $driver_id";
$result = mysqli_query($link, $driver_sql);
$driver = $result->fetch_array(MYSQLI_ASSOC);

$orders_list_sql = "SELECT * FROM orders";
$result = mysqli_query($link, $orders_list_sql);
$order_list = $result->fetch_all(MYSQLI_ASSOC);

$pickup_list_sql = "SELECT * FROM pickup";
$pickup_result = mysqli_query($link, $pickup_list_sql);
$pickup_list = $pickup_result->fetch_all(MYSQLI_ASSOC);

if (isset($_POST['accept_delivery'])) {
    $id = $_POST['id'];
    $driver_name = $driver['full_name'];
    $status = 2;

    $query = "UPDATE `orders` SET `driver_id` = $driver_id, `status` = $status WHERE id = $id";
    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        //update the order status -- assigned driver
        $description = "Your order is now accepted by the rider. Your delivery rider is  $driver_name. Thank you!";
        $query_status = "INSERT INTO order_status(order_id, description)
            VALUES ('$id', '$description')";
        $query_status_run = mysqli_query($link, $query_status);

        //add notification to customer
        $notification = "Your order is now accepted by the rider. Your delivery rider is  $driver_name. Thank you!";
        $notification_query = "INSERT INTO notifications(user_id, url_id, notification)
            VALUES ('$customer_id', '$driver_id', '$notification')";
        mysqli_query($link, $notification_query);

        //add notification to the admin
        $notification = "$driver_name accepted $id for delivery.";
        $notification_query = "INSERT INTO notifications(user_id, url_id, notification, is_for_admin)
            VALUES ('$driver_id', '$customer_id', '$notification', 2)";
        mysqli_query($link, $notification_query);

        $_SESSION['success_status'] = "You have successfully accepted the orders.";
        header("location: order_pickup_list.php");
    }
}

if (isset($_POST['accept_pickup'])) {
    $id = $_POST['id'];
    $driver_name = $driver['full_name'];
    $status = 2;

    $query = "UPDATE `pickup` SET `driver_id` = $driver_id, `status` = $status WHERE id = $id";
    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        //update the pickup status -- assigned driver
        $description = "Your item to pickup is now accepted by the rider. Your delivery rider is  $driver_name. Thank you!";
        $query_status = "INSERT INTO pickup_status(pickup_id, description)
            VALUES ('$id', '$description')";
        $query_status_run = mysqli_query($link, $query_status);

        //add notification to customer
        $notification = "Your item to pickup is now accepted by the rider. Your delivery rider is  $driver_name. Thank you!";
        $notification_query = "INSERT INTO notifications(user_id, url_id, notification)
            VALUES ('$customer_id', '$driver_id', '$notification')";
        mysqli_query($link, $notification_query);

        //add notification to the admin
        $notification = "$driver_name accepted $id for item to pickup.";
        $notification_query = "INSERT INTO notifications(user_id, url_id, notification, is_for_admin)
            VALUES ('$driver_id', '$customer_id', '$notification', 2)";
        mysqli_query($link, $notification_query);

        $_SESSION['success_status'] = "You have successfully accepted the item for pickup.";
        header("location: order_pickup_list.php");
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

        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4><i class="mdi mdi-bike"></i> Order List</h4>
                        </div>
                    </div>
                </div>

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

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Order List</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Pickup List</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="table-responsive mt-4">
                                            <table id="example" class="display" style="min-width: 845px">
                                                <thead>
                                                    <tr>
                                                        <th>Order Code</th>
                                                        <th>Pickup from</th>
                                                        <th>Date</th>
                                                        <th>Delivered to</th>
                                                        <th>Delivery Charge</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($order_list as $order) { ?>
                                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                                            <input type="hidden" id="id" name="id" value="<?php echo $order['id']; ?>" />
                                                            <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $order['customer_id']; ?>" />
                                                            <tr>
                                                                <td>
                                                                    <a href="#" class="card-link" data-toggle="modal" data-target="#order_pickup_info_modal<?php echo $order['id'] ?>">
                                                                        <?php echo $order['order_id']; ?>
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    if ($order['store_id'] > 0) {
                                                                        $store_id = $order['store_id'];;
                                                                        $result = mysqli_query($link, "SELECT * 
                                                                        FROM store WHERE id = $store_id");
                                                                        $store = mysqli_fetch_array($result);

                                                                        echo '<span><strong>' . $store['name'] . '</strong></span><br/><br/>';
                                                                        echo '<span>' . $store['address'] . '</span>';
                                                                    }

                                                                    if ($order['restaurant_id'] > 0) {
                                                                        $restaurant_id = $order['restaurant_id'];;
                                                                        $result = mysqli_query($link, "SELECT *
                                                                        FROM restaurant WHERE id = $restaurant_id");
                                                                        $restaurant = mysqli_fetch_array($result);

                                                                        echo '<span><strong>' . $restaurant['name'] . '</strong></span><br/><br/>';
                                                                        echo '<span>' . $restaurant['address'] . '</span>';
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td><?php echo date('m-d-Y H:i A', strtotime($order['order_date'])); ?></td>
                                                                <td>
                                                                    <?php
                                                                    $customer_id = $order['customer_id'];
                                                                    $result = mysqli_query($link, "SELECT *
                                                                        FROM user_list WHERE id = $customer_id");
                                                                    $customer = mysqli_fetch_array($result);
                                                                    ?>
                                                                    <span class="card-text"><?php echo $customer['full_name']; ?></span><br />
                                                                    <span class="card-text"><?php echo $customer['address']; ?></span><br />
                                                                </td>
                                                                <td><?php echo date('m-d-Y H:i A', strtotime($order['order_date'])); ?></td>
                                                                <td>
                                                                    <button type="submit" name="accept_delivery" class="btn btn-primary float-right">Accept</button>
                                                                </td>
                                                            </tr>
                                                        </form>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="table-responsive mt-4">
                                            <table id="example3" class="display" style="min-width: 845px">
                                                <thead>
                                                    <tr>
                                                        <th>Pickup Code</th>
                                                        <th>Pickup from</th>
                                                        <th>Date</th>
                                                        <th>Delivered to</th>
                                                        <th>Delivery Charge</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($pickup_list as $pickup) { ?>
                                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                                            <input type="hidden" id="id" name="id" value="<?php echo $pickup['id']; ?>" />
                                                            <input type="hidden" id="sender_name" name="sender_name" value="<?php echo $pickup['sender_name']; ?>" />
                                                            <tr>
                                                                <td>
                                                                    <a href="#" class="card-link" data-toggle="modal" data-target="#pickup_info_modal<?php echo $pickup['id'] ?>">
                                                                        <?php echo $pickup['pickup_code']; ?>
                                                                    </a> 
                                                                </td>
                                                                <td>
                                                                    <span><?php echo $pickup['sender_name'] ?></span><br />
                                                                    <span><?php echo $pickup['sender_address'] ?></span><br />
                                                                </td>
                                                                <td><?php echo date('m-d-Y H:i A', strtotime($pickup['date_added'])); ?></td>
                                                                <td>           
                                                                    <span class="card-text"><?php echo $pickup['recipient_name']; ?></span><br />
                                                                    <span class="card-text"><?php echo $pickup['recipient_address']; ?></span><br />
                                                                </td>
                                                                <td><?php echo date('m-d-Y H:i A', strtotime($pickup['date_added'])); ?></td>
                                                                <td>
                                                                    <button type="submit" name="accept_pickup" class="btn btn-primary float-right">Accept</button>
                                                                </td>
                                                            </tr>
                                                        </form>
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
        </div>
    </div>

    <?php include 'includes/feedbacks.php' ?>
    <?php include 'includes/footer.php' ?>

</body>

</html>
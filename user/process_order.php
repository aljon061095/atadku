<?php
    //Include config file
    require_once "includes/config.php";

    //Initialize the session
    session_start();

    $customer_id = $_SESSION["id"];;
    $customer_sql = "SELECT * FROM customer WHERE id = $customer_id";
    $result = mysqli_query($link, $customer_sql);
    $customer = $result->fetch_array(MYSQLI_ASSOC);

    include_once '../class/Order.php';
    $order = new Order($link);
?>

<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<?php include 'includes/header.php' ?>

<body>
    <?php include 'includes/preloader.php' ?>

    <div id="main-wrapper">
        <?php include 'includes/navbar.php' ?>
        <div class="content-body" style="margin-left: 0 !important; padding-top: 3rem;">
            <div class="container-fluid">
                <div class='row'>
                    <?php if (!empty($_GET['order_id'])) {
                        $total = 0;
                        $orderId = $_GET['order_id'];
                        $orderDate = date('Y-m-d');
                        $restaurant_id = 0;

                        $customer_id = $_GET['customer_id'] != null ? $_GET['customer_id'] : $_SESSION['id'];
                        $result = mysqli_query($link, "SELECT *
                                FROM delivery_info WHERE customer_id = $customer_id");
                        $delivery_info = mysqli_fetch_array($result);

                        if (isset($_SESSION["cart"])) {
                            foreach ($_SESSION["cart"] as $keys => $values) {
                                $restaurant_id = $values["restaurant_id"];

                                $order->restaurant_id = $values["restaurant_id"];
                                $order->order_id = $orderId;
                                $order->customer_id = $customer_id;
                                $order->item_id = $values["food_id"];
                                $order->name = $values["name"];
                                $order->price = $values["price"];
                                $order->quantity = $values["quantity"];
                                $order->total = $values["price"] * $values["quantity"];
                                $order->payment_method = $delivery_info["payment_method"];
                                $order->account_name = $delivery_info["account_name"];
                                $order->account_number = $delivery_info["account_number"];
                                $order->order_date = $orderDate;
                                $order->insert();
                            }
                            unset($_SESSION["cart"]);

                            $description = "Your order is now on queue. The delivery rider will contact you soon. Thank you!";

                            $query_status = "INSERT INTO order_status(order_id, description)
                                        VALUES ('$orderId', '$description')";
                            $query_status_run = mysqli_query($link, $query_status);

                            $customer_name = $customer['name'];
                            if ($query_status_run) {
                                $notification = "You have pending orders from $customer_name. See order details. Thank you!";
                                $notification_query = "INSERT INTO notifications(user_id, url_id, notification)
                                    VALUES ('$customer_id', '$restaurant_id', '$notification')";
                                mysqli_query($link, $notification_query);

                                $customer_notification = "Your order is now on queue. The delivery rider will contact you soon. Thank you!";
                                $customer_notification_query = "INSERT INTO notifications(user_id, url_id, notification)
                                    VALUES ('$restaurant_id', '$customer_id', '$customer_notification')";
                                mysqli_query($link, $customer_notification_query);
                            }
                           
                        }
                    ?>
                        <div class="container">
                            <div class="jumbotron">
                                <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span> Order Placed Successfully.</h1>
                            </div>
                        </div>
                        <br>
                        <h2 class="text-center"> Thank you! The ordering process is now complete.</h2>

                        <h3 class="text-center"> <strong>Your Order Number:</strong> <span style="color: blue;"><?php echo $_GET['order_id']; ?></span> </h3>

                        <div class="row text-center mt-4">
                            <a style="text-decoration: none;" href="index.php">
                                <button class="btn btn-secondary">
                                    <i class="mdi mdi-arrow-left-bold"></i>
                                    Go back to Homepage
                                </button>
                            </a>
                        </div>  
                       
                    <?php }  ?>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/feedbacks.php' ?>
    <?php include 'includes/footer.php' ?>
    <?php include 'includes/scripts.php' ?>

</body>
</html>
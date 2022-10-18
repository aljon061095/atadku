<?php
//Include config file
require_once "includes/config.php";

//Initialize the session
session_start();

$customer_id = $_SESSION["id"];;
$customer_sql = "SELECT * FROM customer WHERE id = $customer_id";
$result = mysqli_query($link, $customer_sql);
$customer = $result->fetch_array(MYSQLI_ASSOC);

//update address
if (isset($_POST['update_address'])) {
    $customer_id = $_POST['id'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $contact_number = $_POST['number'];

    $query = "UPDATE `customer` SET `address` = '$address', `number` = '$contact_number',
     `email_address` = '$email' WHERE id = $customer_id";
    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        $_SESSION['success_status'] = "You have successfully updated your delivery address";
        header("location: checkout.php");
    }
}

if (isset($_POST['save_online_payment'])) {
    $customer_id = $_POST['customer_id'];
    $payment_method = $_POST['payment_method'];
    $account_name = $_POST['account_name'];
    $account_number = $_POST['account_number'];

    $query = "INSERT INTO delivery_info(customer_id, payment_method, account_name, account_number)
        VALUES ('$customer_id', '$payment_method', '$account_name', '$account_number')";
    $query_run = mysqli_query($link, $query);
}
?>

<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<?php include 'includes/header.php' ?>

<body>
    <?php include 'includes/preloader.php' ?>

    <div id="main-wrapper">
        <?php include 'includes/navbar.php' ?>
        <?php include 'includes/sidebar.php' ?>
        <div class="content-body" style="margin-left: -5px; padding-top: 7rem;">
            <div class="container-fluid">
                <?php
                $orderTotal = 0;
                foreach ($_SESSION["cart"] as $keys => $values) {
                    $total = ($values["quantity"] * $values["price"]);
                    $orderTotal = $orderTotal + $total;
                }
                ?>
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
                <div class='row'>
                    <div class="col-md-12">
                        <h3>Delivery Information</h3>
                        <p><?php echo $customer["address"]; ?></p>
                        <p><strong>Phone</strong>: <?php echo $customer["number"]; ?></p>
                        <p><strong>Email</strong>: <?php echo $customer["email_address"]; ?></p>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <a style="text-decoration: none;" data-toggle="modal" type="button" data-target="#update_address_modal<?php echo $customer['id']; ?>">
                                    <button class="btn btn-success">Change</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                    $randNumber1 = rand(100000, 999999);
                    $randNumber2 = rand(100000, 999999);
                    $randNumber3 = rand(100000, 999999);
                    $orderNumber = $randNumber1 . $randNumber2 . $randNumber3;
                    ?>
                    <div class="col-md-12 mt-4">
                        <h3>Order Summary</h3>
                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>Items Amount:</strong>: ₱ <?php echo number_format($orderTotal, 2); ?></p>
                                <p><strong>Delivery Fee</strong>: ₱ 49.00</p>
                                <p><strong>Total</strong>: ₱ <?php echo number_format($orderTotal + 49, 2); ?></p>
                            </div>
                            <div class="col-md-8">
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                    <input type="hidden" class="form-control" name="customer_id" value="<?php echo $customer['id']; ?>" id="customer_id">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                                        <label class="form-check-label" for="payment_method">
                                            Cash on Delivery (COD)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="online_payment" value="online_payment">
                                        <label class="form-check-label" for="payment_method">
                                            Online Payment (Gcash)
                                        </label>
                                    </div>
                                    <div id="gcash_account" class="row hidden">
                                        <div class="form-group mt-2 col-md-5">
                                            <div class="form-floating mb-2">
                                                <input type="text" class="form-control" name="account_name" value="<?php echo $customer['full_name']; ?>" id="customer_address" placeholder="Customer Address">
                                                <label for="account_name">Account Name</label>
                                            </div>
                                        </div>
                                        <div class="form-group mt-2 col-md-5">
                                            <div class="form-floating mb-2">
                                                <input type="text" class="form-control" name="account_number" value="<?php echo $customer['number']; ?>" id="customer_address" placeholder="Customer Address">
                                                <label for="customer_address">Gcash Number</label>
                                            </div>
                                        </div>
                                        <div class="form-group mt-3 col-md-2">
                                            <button type="submit" name="save_online_payment" class="btn btn-lg btn-success">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <a style="text-decoration: none;" href="cart.php">
                                    <button class="btn btn-secondary">Back to Cart</button>
                                </a>
                                <a style="text-decoration: none;" href="process_order.php?order_id=<?php echo $orderNumber; ?>&customer_id=<?php echo $customer['id'];?>">
                                    <button class="btn btn-primary">Place Order</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="update_address_modal<?php echo $customer['id'] ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Update Delivery Information</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="form-floating mb-2">
                                <input type="hidden" class="form-control" name="id" value="<?php echo $customer['id']; ?>">
                                <input type="text" class="form-control" name="address" value="<?php echo $customer['address']; ?>" id="customer_address" placeholder="Customer Address">
                                <label for="customer_address">Customer Address</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-floating mb-2">
                                <input type="email" class="form-control" name="email" value="<?php echo $customer['email_address']; ?>" id="email" placeholder="Email Address">
                                <label for="email">Email Address</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-floating mb-2">
                                <input type="number" class="form-control" name="number" value="<?php echo $customer['number']; ?>" id="number" placeholder="Contact Number">
                                <label for="number">Contact Number</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="update_address" class="btn btn-primary">Save changes</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php' ?>

    <!--**********************************
        Scripts
    ***********************************-->
    <script>
        $('input[type=radio][name=payment_method]').change(function() {
            if (this.value == 'online_payment') {
                $("#gcash_account").removeClass('hidden');
            }
            else {
                $("#gcash_account").addClass('hidden');
            }
        });
    </script>                


    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
    <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/deznav-init.js"></script>
    <!-- Apex Chart -->
    <script src="vendor/apexchart/apexchart.js"></script>

    <script src="vendor/highlightjs/highlight.pack.min.js"></script>
    <!-- Circle progress -->
</body>

</html>
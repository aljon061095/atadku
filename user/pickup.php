<?php
require_once "includes/config.php";

//session start
session_start();

$store_sql = "SELECT * FROM store";
$result = mysqli_query($link, $store_sql);
$stores = $result->fetch_all(MYSQLI_ASSOC);

$customer_id = $_SESSION["id"];
$customer_sql = "SELECT * FROM customer WHERE id = $customer_id";
$customer_result = mysqli_query($link, $customer_sql);
$customer = $customer_result->fetch_array(MYSQLI_ASSOC);

if (isset($_POST['pickup_save'])) {
    $pickup_code = substr(md5(uniqid(rand(1,6))), 0, 8);
    $sender_name = $_POST['sender_name'];
    $sender_number = $_POST['sender_number'];
    $sender_address = $_POST['sender_address'];
    $item_details = $_POST['item_details'];
    $notes = $_POST['notes'];
    $recipient_name = $_POST['recipient_name'];
    $recipient_number = $_POST['recipient_number'];
    $recipient_address = $_POST['recipient_address'];
    $message = $_POST['message'];
    $status = 1;

    $query = "INSERT INTO pickup(pickup_code, sender_name, sender_number, sender_address, item_details, notes, recipient_name, recipient_number, recipient_address, message, status)
            VALUES ('$pickup_code', '$sender_name', '$sender_number', '$sender_address', '$item_details', '$notes', '$recipient_name', '$recipient_number', '$recipient_address', '$message', '$status')";
    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        //create a pickup status
        $pickup_id = $link->insert_id;
        $description = "The item for pickup is now on queue. Just wait for the administrator approval.";

        $query_status = "INSERT INTO pickup_status(pickup_id, description)
            VALUES ('$pickup_id', '$description')";
        $query_status_run = mysqli_query($link, $query_status);

        if ($query_status_run) {
            $notification = "There was an item for pickup from $sender_name that needs your approval.";
            $notification_query = "INSERT INTO notifications(user_id, url_id, notification)
                VALUES ('$customer_id', '$customer_id', '$notification')";
            mysqli_query($link, $notification_query);
        }

        $_SESSION['success_status'] = "You have successfully added $pickup_code item for pickup.";
        header("location: pickup_list.php");
    }
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
        <div class="content-body" style="padding-top: 5rem;">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6">
                        <div class="welcome-text">
                            <h4><i class="mdi mdi-navigation"></i> Pickup Details</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card p-2">
                            <div class="card-body">
                                <div class="profile-blog mb-5">
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h4 class="mb-4">Sender's Information</h4>
                                                <div class="form-group">
                                                    <div class="form-floating mb-2">
                                                        <input type="text" class="form-control" name="sender_name"  id="sender_name" placeholder="Sender's Name" value="<?php echo $customer['full_name']; ?>" required>
                                                        <label for="sender_name">Sender's Name</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-floating mb-2">
                                                        <input type="number" class="form-control" name="sender_number"  id="sender_number" placeholder="Contact Number" value="<?php echo $customer['number']; ?>" required>
                                                        <label for="sender_number">Contact Number</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-floating mb-2">
                                                        <input type="text" class="form-control" name="sender_address" id="sender_address" placeholder="Address" value="<?php echo $customer['address']; ?>" required>
                                                        <label for="sender_address">Address</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-floating">
                                                        <select class="form-select" style="padding: 0.9rem;" id="item_details" name="item_details" required>
                                                            <option selected value="">Type of Item</option>
                                                            <option value="document">Document</option>
                                                            <option value="food">Food</option>
                                                            <option value="clothing">Clothing</option>
                                                            <option value="electronics">Electronics</option>
                                                            <option value="fragile">Fragile</option>
                                                            <option value="medical">Medical</option>
                                                            <option value="others">Others</option>
                                                        </select>
                                                        <label for="item_details"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-floating mb-2">
                                                        <textarea name="notes" id="textarea" cols="10" rows="2" class="form-control bg-transparent" placeholder="Please write anything you want to post here..." required></textarea>
                                                        <label for="sender_address">Add notes to driver (optional)</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <h4 class="mb-4">Deliver to</h4>
                                                <div class="form-group">
                                                    <div class="form-floating mb-2">
                                                        <input type="text" class="form-control" name="recipient_name" value="" id="recipient_name" placeholder="Recipient's Name" required>
                                                        <label for="recipient_name">Recipient's Name</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-floating mb-2">
                                                        <input type="number" class="form-control" name="recipient_number" value="" id="recipient_number" placeholder="Recipient's Number" required>
                                                        <label for="sender_number">Recipient's Number</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-floating mb-2">
                                                        <input type="text" class="form-control" name="recipient_address" value="" id="sender_address" placeholder="Recipient's Address" required>
                                                        <label for="sender_address">Recipient's Address</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-floating mb-2">
                                                        <textarea name="message" id="textarea" cols="40" rows="5" class="form-control bg-transparent"></textarea>
                                                        <label for="sender_address">Add simple greeting for recipients (optional)</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row text-center">
                                                <div class="col-md-12">
                                                    <a href="pickup_list.php" class="btn btn-secondary">Cancel</a>
                                                    <button type="submit" name="pickup_save" class="btn btn-primary">Submit</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
<?php
require_once "includes/config.php";

//session start
session_start();

if (isset($_POST['delivered'])) {
    $id = $_POST['pickup_id'];
    $status = 3;

    $query = "UPDATE `pickup` SET `status` = $status WHERE id = $id";
    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        //update the pickup status -- delivered by the rider
        $pickup_id = $link->insert_id;
        $description = "The item for pickup is now delivered. Thank you for choosing our delivery system!";

        $query_status = "INSERT INTO pickup_status(pickup_id, description)
                    VALUES ('$pickup_id', '$description')";
        $query_status_run = mysqli_query($link, $query_status);

        $_SESSION['success_status'] = "You have successfully updated the status of the pickup";
        header("location: pickup_list.php");
    }
}

$pickup_id = $_GET['pickup_id'];
$pickup_sql = "SELECT * FROM pickup WHERE id = $pickup_id";
$result = mysqli_query($link, $pickup_sql);
$pickup = $result->fetch_array(MYSQLI_ASSOC);

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
                            <h4><i class="mdi mdi-cart-plus"></i> Pickup Info</h4>
                            <div>
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                    <input type="hidden" name="pickup_id" value="<?php echo $pickup_id; ?>" />
                                    <button type="submit" name="delivered" class="btn btn-success">Delivered</button>
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
                                                <input type="text" class="form-control" value="<?php echo $pickup["pickup_code"]; ?>" name="pickup_code" id="pickup_code" placeholder="Pickup Code" readonly>
                                                <label for="price">Pickup Code</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-floating mb-2">
                                                <input type="text" class="form-control" name="sender_name" value="<?php echo $pickup["sender_name"]; ?>" id="sender_name" placeholder="Sender Name" readonly>
                                                <label for="food_name">Sender's Name</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-floating mb-2">
                                                <input type="number" class="form-control" value="<?php echo $pickup["sender_number"]; ?>" name="sender_number" id="sender_number" placeholder="Sender's Name" readonly>
                                                <label for="sender_number">Sender's Number</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-floating mb-2">
                                                <input type="text" class="form-control" value="<?php echo $pickup["sender_address"]; ?>" name="sender_address" id="sender_address" placeholder="Sender's Address" readonly>
                                                <label for="sender_address">Sender's Address</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-floating mb-2">
                                                <input type="text" class="form-control" name="item_details" value=" <?php echo $pickup['item_details']; ?>" id="item_details" placeholder="Item Details" readonly>
                                                <label for="item_details">Item Details</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-floating mb-2">
                                                <textarea name="notes" id="textarea" cols="10" rows="2" class="form-control bg-transparent" readonly><?php echo $pickup['notes']; ?></textarea>
                                                <label for="sender_address">Add notes to driver (optional)</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="form-floating mb-2">
                                                <input type="text" class="form-control" value="<?php echo $pickup['recipient_name']; ?>" name="recipient_name" id="recipient_name" placeholder="Email" readonly>
                                                <label for="recipient_name">Recipient's Name</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-floating mb-2">
                                                <input type="number" class="form-control" value="<?php echo $pickup['recipient_number']; ?>" placeholder="Recipient's number" name="recipient_number" id="recipient_number" readonly>
                                                <label for="recipient_number">Recipient's Number</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-floating mb-2">
                                                <input type="text" class="form-control" value="<?php echo $pickup['recipient_address']; ?>" placeholder="Recipient's Address" name="recipient_address" id="recipient_address" readonly>
                                                <label for="username">Recipient's Address</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-floating mb-2">
                                                <textarea name="message" id="textarea" cols="40" rows="5" class="form-control bg-transparent" readonly><?php echo $pickup['message']; ?></textarea>
                                                <label for="sender_address">Add simple greeting for recipients (optional)</label>
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

    <?php include 'includes/feedbacks.php' ?>
    <?php include 'includes/footer.php' ?>

    <script>
        $('#driver').on('change', function(e) {
            var value = $(e.currentTarget).find(":selected").val();
            console.log(value);
            $('#driver_id').val(value);
        });
    </script>

</body>

</html>
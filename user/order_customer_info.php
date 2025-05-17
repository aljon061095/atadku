<?php
//Include config file
require_once "includes/config.php";

//Initialize the session
session_start();

$order_id = $_GET["order_id"];
$order_sql = "SELECT * FROM order_status WHERE order_id = $order_id";
$result = mysqli_query($link, $order_sql);
$order_infos = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<link href="../vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

<?php include 'includes/header.php' ?>


<body>

    <?php include 'includes/preloader.php' ?>
    <div id="main-wrapper">

        <?php include 'includes/navbar.php' ?>
        <?php include 'includes/sidebar.php' ?>

        <div class="content-body" style="padding-top: 3rem;">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4><i class="mdi mdi-information"></i> Order Information</h4>
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
                    <?php foreach ($order_infos as $order_info) { ?>
                        <div class="col-md-12 col-lg-12">
                            <div id="tracking-pre"></div>
                            <div id="tracking">
                                <div class="tracking-list">
                                    <div class="tracking-item">
                                        <div class="tracking-icon status-intransit">
                                            <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                            </svg>
                                        </div>
                                        <div class="tracking-date"><?php echo $order_info["date_updated"]; ?></div>
                                        <div class="tracking-content"><?php echo $order_info["description"]; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/feedbacks.php' ?>
    <?php include 'includes/footer.php' ?>

</body>

</html>
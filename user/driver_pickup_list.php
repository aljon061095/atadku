<?php
    //Include config file
    require_once "includes/config.php";

    //Initialize the session
    session_start();

    $driver_id = $_SESSION["id"] ;
    $pickup_sql = "SELECT * FROM pickup";
    $result = mysqli_query($link, $pickup_sql);
    $pickup_list = $result->fetch_all(MYSQLI_ASSOC);

    if (isset($_POST["ExportType"])) {
        switch ($_POST["ExportType"]) {
            case "export-to-excel":
                // Submission from
                $filename = "Restaurant" . ".xls";
                header("Content-Type: application/vnd.ms-excel");
                header("Content-Disposition: attachment; filename=\"$filename\"");
                ExportFile($pickup_list);
                exit();
            default:
                die("Unknown action : " . $_POST["action"]);
                break;
        }
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

<?php include 'includes/header.php'?>
    <!-- Datatable -->
<body>

    <?php include 'includes/preloader.php'?>
    <div id="main-wrapper">

        <?php include 'includes/navbar.php'?>
        <?php include 'includes/sidebar.php'?>

        <div class="content-body">
        <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4><i class="mdi mdi-navigation"></i> Pickup List</h4>
                            <div class="col-md-12 float-right mb-4">
                                <div class="btn-group pull-right">
                                    <button type="button" class="btn fs-22 py-1 btn-info ml-2" id="export-to-excel">
                                        <i class="mdi mdi-download"></i>
                                        Export
                                    </button>
                                </div>
                                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" id="export-form">
                                    <input type="hidden" value='' id='hidden-type' name='ExportType' />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <?php
                        if (isset($_SESSION['success_status'])) {
                        ?>
                            <div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">??</button>
                                <?php echo $_SESSION['success_status']; ?>
                            </div>
                        <?php
                            unset($_SESSION['success_status']);
                        }
                    ?>
                </div>

                <!--driver-->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Pickup Code</th>
                                                <th>Sender's Name</th>
                                                <th>Sender's Number</th>
                                                <th>Sender's Address</th>
                                                <th>Item Details</th>
                                                <th>Notes</th>
                                                <th>Recipient's Name</th>
                                                <th>Recipient's Number</th>
                                                <th>Recipient's Address</th>
                                                <th>Message</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($pickup_list as $pickup) { ?>
                                                <tr>
                                                    <td>
                                                        <a href="driver_pickup_info.php?pickup_id=<?php echo $pickup['id']; ?>">
                                                            <?php echo $pickup['pickup_code']; ?>
                                                        </a>
                                                    </td>
                                                    <td><?php echo $pickup['sender_name']; ?></td>
                                                    <td><?php echo $pickup['sender_number']; ?></td>
                                                    <td><?php echo $pickup['sender_address']; ?></td>
                                                    <td><?php echo $pickup['item_details']; ?></td>
                                                    <td><?php echo $pickup['notes']; ?></td>
                                                    <td><?php echo $pickup['recipient_name']; ?></td>
                                                    <td><?php echo $pickup['recipient_number']; ?></td>
                                                    <td><?php echo $pickup['recipient_address']; ?></td>
                                                    <td><?php echo $pickup['message']; ?></td>
                                                    <td>
                                                        <?php if ($pickup['status'] == 2) { ?>
                                                            <span class="badge light badge-info">
                                                                <i class="fa fa-circle text-info mr-1"></i>
                                                                ready for delivery
                                                            </span>
                                                        <?php } else if ($pickup['status'] == 3) { ?>
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
    <?php include 'includes/footer.php'?>

</body>

</html>
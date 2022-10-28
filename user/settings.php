<?php
    //Include config file
    require_once "includes/config.php";

    session_start();

    $owner_id =  $_SESSION["id"];
    $settings_sql = "SELECT * FROM settings WHERE owner_id = $owner_id";
    $result = mysqli_query($link, $settings_sql);
    $settings = $result->fetch_array(MYSQLI_ASSOC);

    $owner_id =  $_SESSION["id"];
    if (isset($_POST['save_settings'])) {
        $delivery_charge = $_POST['delivery_charge'];
        $admin_commission = $_POST['admin_commission'];

        $checkRecord = mysqli_query($link, "SELECT * FROM settings WHERE owner_id=" . $owner_id);
        $totalrows = mysqli_num_rows($checkRecord);
    
        if ($totalrows > 0) {
            $query = "UPDATE `settings` SET `delivery_charge` = $delivery_charge, 
                `admin_commission` = $admin_commission  WHERE owner_id = $owner_id";
            mysqli_query($link, $query);
        } else {
            $query = "INSERT INTO settings(owner_id, delivery_charge, admin_commission)
                VALUES ('$owner_id', '$delivery_charge', '$admin_commission')";
            mysqli_query($link, $query);
        }

        $_SESSION['success_status'] = "You have successfully updated your delivery settings.";
        header("location: settings.php");
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

        <?php include 'includes/topbar.php'?>
        <?php include 'includes/sidebar.php'?>

        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4><i class="mdi mdi-cogs"></i> System Settings</h4>
                        </div>
                    </div>
                </div>
                <!-- row -->
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
					<div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Update Settings</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Administrator's Commission</label>
                                            <div class="col-sm-6">
                                                <input type="number" class="form-control" name="admin_commission" value="<?php echo isset($settings) ? $settings['admin_commission'] : "" ?>" placeholder="ex. 12%">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Drivers Rate</label>
                                            <div class="col-sm-6">
                                                <input type="number" class="form-control" name="delivery_charge" value="<?php echo isset($settings) ? $settings['delivery_charge'] : "" ?>" placeholder="ex. 536">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <button type="submit" name="save_settings" class="btn btn-primary">Save</button>
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

    <?php include 'includes/footer.php'?>

</body>

</html>